<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Database;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Symfony\Component\VarDumper\Cloner\Data;

class UserController extends Controller
{
    public function register(Request $request){
        if ($request->has('_token')){
            $userName = $request->input('usr');
            $password = $request->input('pwd');
            $row_number = DB::table('users')->where('userName', $userName)->count();
            if ($row_number > 0) {
                $result_string = 'The username is used. Please select another username!';
            } else{
                $hash = password_hash($password, PASSWORD_DEFAULT);
                DB::insert('insert into users (userName, password) values (?, ?)', [$userName, $hash]);
                $user = DB::table('users')->where('userName', $userName)->first();
                if ($userName == $user->userName) {
                    $result_string = 'Register Success!';
                } else {
                    $result_string = 'Register failure!';
                }
            }
            return view('profile.register', ['result_string' => $result_string]);
        } else{
            exit("Your form is empty");
        }
    }

    public function loginValidate(Request $request){
        $result_string = "";
        if (Cookie::has('username')){
            $username = Cookie::get('username');
            $user = DB::table('users')->where('userName', $username)->first();
            if ($user->learnprogress == 0){
                $result_string = "You need to finish test1 first.";
            }
            else if ($user->learnprogress == 1){
                $result_string = "You have finished test1, why not finish test2?";
            }
            else if ($user->learnprogress == 2){
                $result_string = "You have finished all tests";
            }
            return view('profile.profile', [
                'result_string' => $result_string,
                'username' => $username,
                'learn_grade' => $user->grade_1 + $user->grade_2,
            ]);
        }
        else{
            return view('profile');
        }
    }

    public function login(Request $request){
        $userName = $request->input('usr');
        $password = $request->input('pwd');
        $row_number = DB::table('users')->where('userName', $userName)->count();
        if ($row_number > 0){
            $user = DB::table('users')->where('userName', $userName)->first();
            $hash = $user->password;
            if (password_verify($password, $hash)){
                $request->session()->put("username", $userName);
                Cookie::queue("username", $userName, 2628000);
                return redirect()->route(('profile/profile'));
            }else{
                return view('profile.login');
            }
        }else{
            return view('profile.login');
        }

    }

    public function logout(Request $request){
        return redirect('profile')->cookie(cookie()->forget('username'));
    }

    public function reportValidate(Request $request){
        if (Cookie::has('username')){
            $username = Cookie::get('username');
            $user = DB::table('users')->where('userName', $username)->first();
            if ($user->authentication == 0){
                return redirect()->back()->with('alert', 'You do not have the authentication to view report');
            }
            else{
                $progress = array(0,0,0);
                $grade1 = array(0,0,0,0);
                $grade2 = array(0,0,0,0);
                $grade = array(0,0,0,0);
                $total_grade1 = 0;
                $total_grade2 = 0;
                $users = DB::table('users')->get();
                foreach ($users as $user){
                    $progress[$user->learnprogress] += 1;
                    $grade1_p = $user->grade_1;
                    $grade2_p = $user->grade_2;
                    $grade_p = $grade1_p + $grade2_p;
                    if ($user->learnprogress >= 1){
                        $total_grade1 += $grade1_p;
                    }
                    if ($user->learnprogress == 2){
                        $total_grade2 += $grade2_p;
                    }

                    if ($grade1_p < 20) $grade1[0] += 1;
                    else if ($grade1_p >= 20 && $grade1_p < 40) $grade1[1] += 1;
                    else if ($grade1_p >= 40 && $grade1_p < 60) $grade1[2] += 1;
                    else $grade1[3] += 1;

                    if ($grade2_p < 20) $grade2[0] += 1;
                    else if ($grade2_p == 20) $grade2[1] += 1;
                    else if ($grade2_p == 30) $grade2[2] += 1;
                    else $grade2[3] += 1;

                    if ($grade_p < 30) $grade[0] += 1;
                    else if ($grade_p >= 30 && $grade_p < 60) $grade[1] += 1;
                    else if ($grade_p >= 60 && $grade_p < 90) $grade[2] += 1;
                    else $grade[3] += 1;
                }
                if($progress[2] == 0){
                    $avg2 = 0;
                }
                else{
                    $avg2 = $total_grade2 * 100 / 40 / $progress[2];
                }
                if ($progress[2] == 0 && $progress[1] == 0){
                    $avg1 = 0;
                }
                else{
                    $avg1 = $total_grade1 * 100 / 70 / ($progress[1] + $progress[2]);
                }
                return view('profile.report', [
                    'username' => $username,
                    'progress' => $progress,
                    'grade1' => $grade1, 'grade2' => $grade2,
                    'avg1' => $avg1, 'avg2' => $avg2,
                    'grade' => $grade
                ]);
            }
        } else {
            return view('profile');
        }
    }

    public function testValidate(){
        if (Cookie::has('username')){
            $username = Cookie::get('username');
            $user = DB::table('users')->where('userName', $username)->first();
            $result_string = "";
            if ($user->learnprogress == 0){
                $result_string = "You need to finish test1 first.";
            }
            else if ($user->learnprogress == 1){
                $result_string = "You have finished test1, why not finish test2?";
            }
            else if ($user->learnprogress == 2){
                $result_string = "You have finished all tests";
            }
            return view('profile.test',[
                'username' => $username,
                'result_string' => $result_string,
                'learn_grade1' => $user->grade_1,
                'learn_grade2' => $user->grade_2,
            ]);
        }
        else{
            return view('profile');
        }
    }

    public function oracle(Request $request){
        if (Cookie::has('username')){
            $test_name = $request->input('test');
            $username = Cookie::get('username');
            $user = DB::table('users')->where('userName', $username)->first();
            $grade = 0;
            $alphabet = array("a", "b", "c", "d", "e", "f", "g");
            $result_string = "";
            if ($test_name == 'test1'){
                $answers = array("", "", "", "", "", "", "");
                $answers[0] = $request->input('q1');
                $answers[1] = $request->input('q2');
                $answers[2] = $request->input('q3');
                $answers[3] = $request->input('q4');
                $answers[4] = $request->input('q5');
                $answers[5] = $request->input('q6');
                if ($answers[0] == 'q1a'){ $result_string = $result_string . 'The question 1 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 1 is wrong. The right answer is a.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 26]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 26,
                                'count' => 1, 'topic' => 'general',
                                'level' => 1]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 26]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 26]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[1] == 'q2b'){ $result_string = $result_string . 'The question 2 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 2 is wrong. The right answer is b.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 27]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 27,
                                'count' => 1, 'topic' => 'general',
                                'level' => 1]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 27]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 27]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[2] == 'q3d'){$result_string = $result_string . 'The question 3 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 3 is wrong. The right answer is d.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 28]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 28,
                                'count' => 1, 'topic' => 'general',
                                'level' => 1]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 28]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 28]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[3] == 'q4t'){ $result_string = $result_string . 'The question 4 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 4 is wrong. The right answer is true.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 29]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 29,
                                'count' => 1, 'topic' => 'general',
                                'level' => 1]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 29]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 29]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[4] == 'q5t'){ $result_string = $result_string . 'The question 5 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 5 is wrong. The right answer is true.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 30]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 30,
                                'count' => 1, 'topic' => 'general',
                                'level' => 1]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 30]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 30]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[5] == 'q6t'){ $result_string = $result_string . 'The question 6 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 6 is wrong. The right answer is true.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 31]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 31,
                                'count' => 1, 'topic' => 'general',
                                'level' => 1]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 31]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 31]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                $result_7 = 0;
                for ($i=0; $i<6; $i++){
                    if ($request->has('q7'.$alphabet[$i])){
                        $result_7 += $request->input('q7'.$alphabet[$i]);
                    }
                }
                if ($result_7 == 5) {$result_string = $result_string . "The question 7 is right.<br>"; $grade += 10;}
                else {
                    $result_string = $result_string . "The question 7 is wrong. The right answer is abcdf.<br>";
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 32]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 32,
                                'count' => 1, 'topic' => 'general',
                                'level' => 1]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 32]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 32]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                $result_string = $result_string . "Your grade of test1 is " . $grade . "<br>";

                if ($grade > $user->grade_1){
                    DB::table('users')
                        ->where('userName', $username)
                        ->update(['grade_1' => $grade]);
                }

                if ($user->learnprogress <= 1){
                    DB::table('users')
                        ->where('userName', $username)
                        ->update(['learnprogress' => 1]);
                }

            }
            if ($test_name == 'test2'){
                $answers = array("", "", "", "", "");
                $answers[0] = $request->input('q1');
                $answers[1] = $request->input('q2');
                $answers[2] = $request->input('q3');
                $answers[3] = $request->input('q4');
                if ($answers[0] == 'q1a'){ $result_string = $result_string . 'The question 1 is right<br>';  $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 1 is wrong. The right answer is a.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 33]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 33,
                                'count' => 1, 'topic' => 'general',
                                'level' => 2]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 33]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 33]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[1] == 'q2b'){ $result_string = $result_string . 'The question 2 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 2 is wrong. The right answer is b.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 34]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 34,
                                'count' => 1, 'topic' => 'general',
                                'level' => 2]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 34]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 34]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[2] == 'q3d'){ $result_string = $result_string . 'The question 3 is right<br>'; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 3 is wrong. The right answer is d.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 35]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 35,
                                'count' => 1, 'topic' => 'general',
                                'level' => 2]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 35]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 35]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                if ($answers[3] == 'Yes'){ $result_string = $result_string . "The question 4 is right<br>"; $grade += 10;}
                else{
                    $result_string = $result_string . 'The question 4 is wrong. The right answer is yes.<br>';
                    $num = DB::table('wrong')->where([['userName', '=', $username],
                        ['qid', '=', 36]])->count();
                    if ($num == 0){
                        DB::table('wrong')->insert(
                            ['userName' => $username, 'qid' => 36,
                                'count' => 1, 'topic' => 'general',
                                'level' => 2]
                        );
                    }else{
                        $question = DB::table('wrong')->where([['userName', '=', $username],
                            ['qid', '=', 36]])->first();
                        DB::table('wrong')
                            ->where([['userName', '=', $username], ['qid', '=', 36]])
                            ->update(['count' => $question->count + 1]);
                    }
                }
                $result_string = $result_string . "Your grade of test2 is " . $grade . "<br>";

                if ($grade > $user->grade_2){
                    DB::table('users')
                        ->where('userName', $username)
                        ->update(['grade_2' => $grade]);
                }

                if ($user->learnprogress <= 2){
                    DB::table('users')
                        ->where('userName', $username)
                        ->update(['learnprogress' => 2]);
                }
            }
            if ($test_name == 'test3'){
                $index=1;
                $input_x = Input::get();
                foreach ($input_x as $k => $va){
                    if (strpos($k, "MCQ") !== false || strpos($k, "SCQ") !== false
                        || strpos($k, "BLANK") !== false){
                        $arr = explode('_',$k);
                        if (count($arr) > 1){
                            $key=$arr[1];
                            $type=$arr[0];
                            if ($type=='MCQ' or $type=='BLANK'){
                                $val = implode('', (array) $request->get($k));
                                //$result_string = $result_string . $k . '/////' . $val . '<br>';
                                /*if ($type=='MCQ'){
                                    $val=implode($va);}
                                else{
                                    $val=$va;
                                }*/
                                $result = DB::table('exercise')
                                    ->where('qid', '=', $key)
                                    ->where('answer', '=', $val)
                                    ->get();
                                $count = DB::table('exercise')
                                    ->where('qid', '=', $key)
                                    ->where('answer', '=', $val)
                                    ->count();
                                $ans = DB::table('exercise')
                                    ->select('answer')
                                    ->where('qid', '=', $key)
                                    ->first();

                                if ($count >0) {
                                    $result_string = $result_string . 'The question '. $index. ' is right<br>';
                                    $grade += 10;
                                }
                                else {
                                    //update the db
                                    $result_string = $result_string . 'The question '. $index.' is wrong. The right answer is '.$ans->answer.'. The question has been added into your mistakes records.<br>';
                                    $result_1 = DB::table('wrong')
                                        ->where('userName', '=', $username)
                                        ->where('qid', '=', $key)
                                        ->first();
                                    $count_1 = DB::table('wrong')
                                        ->where('userName', '=', $username)
                                        ->where('qid', '=', $key)
                                        ->count();
                                    if ($count_1 >0){
                                        $count=$result_1->count+1;
                                        DB::table('wrong')
                                            ->where('userName', $username)
                                            ->where('qid', '=', $key)
                                            ->update(['count' => $count]);
                                    }
                                    else{
                                        $result_2 = DB::table('exercise')
                                            ->select('topic', 'level')
                                            ->where('qid', '=', $key)
                                            ->first();
                                        $result_2_count = DB::table('exercise')
                                            ->select('topic', 'level')
                                            ->where('qid', '=', $key)
                                            ->count();
                                        if ($result_2_count != 0){
                                            DB::table('wrong')->insert(
                                                ['userName' => $username, 'qid' => $key,
                                                    'count' => 1, 'topic' => $result_2->topic,
                                                    'level' => $result_2->level]);
                                        }
                                    }
                                }
                            }
                            elseif ($type=='SCQ')
                            {
                                $val=$va;
                                if ($val=='A'or $val=='B' or $val=='C' or $val=='D'or $val=='E'or $val=='F'){
                                    $result = DB::table('exercise')
                                        ->where('qid', '=', $key)
                                        ->where('answer', '=', $val)
                                        ->get();
                                    $count = DB::table('exercise')
                                        ->where('qid', '=', $key)
                                        ->where('answer', '=', $val)
                                        ->count();
                                    $ans = DB::table('exercise')
                                        ->select('answer')
                                        ->where('qid', '=', $key)
                                        ->first();

                                    if ($count >0) {
                                        $result_string = $result_string . 'The question '. $index. ' is right<br>';
                                        $grade += 10;
                                    }
                                    else{
                                        $result_string = $result_string . 'The question '. $index.' is wrong. The right answer is '.$ans->answer.'. The question has been added into your mistakes records.<br>';
                                        //update the db
                                        $result_1 = DB::table('wrong')
                                            ->where('userName', '=', $username)
                                            ->where('qid', '=', $key)
                                            ->first();
                                        $count_1 = DB::table('wrong')
                                            ->where('userName', '=', $username)
                                            ->where('qid', '=', $key)
                                            ->count();

                                        if ($count_1 >0){
                                            $count=$result_1->count+1;
                                            DB::table('wrong')
                                                ->where('userName', $username)
                                                ->where('qid', '=', $key)
                                                ->update(['count' => $count]);
                                        }
                                        else{
                                            $result_2 = DB::table('exercise')
                                                ->select('topic', 'level')
                                                ->where('qid', '=', $key)
                                                ->first();
                                            $result_2_count = DB::table('exercise')
                                                ->select('topic', 'level')
                                                ->where('qid', '=', $key)
                                                ->count();
                                            if ($result_2_count != 0){
                                                DB::table('wrong')->insert(
                                                    ['userName' => $username, 'qid' => $key,
                                                        'count' => 1, 'topic' => $result_2->topic,
                                                        'level' => $result_2->level]);
                                            }
                                        }
                                    }
                                }
                            }
                            $index=$index+1;
                        }
                    }
                }
                $result_string = $result_string . "Your grade of last test is " . $grade . "<br>";
            }
            return view('profile.oracle',[
                'test_name' => $test_name,
                'result_string' => $result_string,
            ]);
        }
        else{
            return view('profile');
        }
    }

    public function animate(Request $request){
        $algorithm = $request->input('algorithm');
        $str = $request->input('str');
        $animation = "";
        if ($algorithm == 1){
            $animation = "arr=[".$str."];"."bubbleSort(arr);";
        } else if ($algorithm == 2){
            $animation = "arr=[".$str."];"."insertSort(arr);";
        } else if($algorithm =="3"){
            $animation = "arr=[".$str."];"."countSort(arr);";
        }
        if($algorithm =="4"){
            $animation = "arr=[".$str."];"."selectSort(arr);";
        }
        if($algorithm =="5"){
            $animation = "arr=[".$str."];"."shellSort(arr);";
        }
        return view('game',['animation' => $animation,
            'str' => $str]);
    }

    public function test_wrongValidate(Request $request, $mode){
        if (Cookie::has('username')){
            if ($mode == 'test3'){$mode = 'AI';}
            else if ($mode == "review_T1"){$mode = "level1";}
            else if ($mode == "review_T2"){$mode = "level2";}
            else if ($mode == "review_All"){$mode = "all";}
            else{
                $mode = $request->get('mode');
            }
            $userName = Cookie::get('username');
        }
        else{
            return view('profile');
        }
        $result = "";
        $count = 0;
        if ($mode == 'level1') {
            $result = DB::table('wrong')
                ->join('exercise', 'wrong.qid', '=', 'exercise.qid')
                ->select('wrong.count', 'exercise.content', 'exercise.type',
                    'exercise.A', 'exercise.B', 'exercise.C', 'exercise.D', 'exercise.E',
                    'exercise.F', 'exercise.topic', 'exercise.answer' , 'exercise.qid',
                    'wrong.userName', 'wrong.level')
                ->where([['wrong.userName', '=', $userName], ['wrong.level', '=', 1]])
                ->orderByDesc('wrong.count')
                ->get();
            $count = DB::table('wrong')
                ->join('exercise', 'wrong.qid', '=', 'exercise.qid')
                ->select('wrong.count', 'exercise.content', 'exercise.type',
                    'exercise.A', 'exercise.B', 'exercise.C', 'exercise.D', 'exercise.E',
                    'exercise.F', 'exercise.topic', 'exercise.answer' , 'exercise.qid',
                    'wrong.userName', 'wrong.level')
                ->where('wrong.userName', '=', $userName)
                ->where('wrong.level', '=', 1)
                ->orderByDesc('wrong.count')
                ->count();
        }
        else if ($mode == 'level2'){
            $result = DB::table('wrong')
                ->join('exercise', 'wrong.qid', '=', 'exercise.qid')
                ->where([['wrong.userName', '=', $userName], ['wrong.level', '=', 2]])
                ->select('wrong.count', 'exercise.content', 'exercise.type',
                    'exercise.A', 'exercise.B', 'exercise.C', 'exercise.D', 'exercise.E',
                    'exercise.F', 'exercise.topic', 'exercise.answer' , 'exercise.qid',
                    'wrong.userName', 'wrong.level')
                ->orderByDesc('wrong.count')
                ->get();
            $count = DB::table('wrong')
                ->join('exercise', 'wrong.qid', '=', 'exercise.qid')
                ->where([['wrong.userName', '=', $userName], ['wrong.level', '=', 2]])
                ->select('wrong.count', 'exercise.content', 'exercise.type',
                    'exercise.A', 'exercise.B', 'exercise.C', 'exercise.D', 'exercise.E',
                    'exercise.F', 'exercise.topic', 'exercise.answer' , 'exercise.qid',
                    'wrong.userName', 'wrong.level')
                ->orderByDesc('wrong.count')
                ->count();
        }
        else if ($mode == 'all') {
            $result = DB::table('wrong')
                ->join('exercise', 'wrong.qid', '=', 'exercise.qid')
                ->where('wrong.userName', '=', $userName)
                ->select('wrong.count', 'exercise.content', 'exercise.type',
                    'exercise.A', 'exercise.B', 'exercise.C', 'exercise.D', 'exercise.E',
                    'exercise.F', 'exercise.topic', 'exercise.answer' , 'exercise.qid',
                    'wrong.userName', 'wrong.level')
                ->orderByDesc('wrong.count')
                ->get();
            $count = DB::table('wrong')
                ->join('exercise', 'wrong.qid', '=', 'exercise.qid')
                ->where('wrong.userName', '=', $userName)
                ->select('wrong.count', 'exercise.content', 'exercise.type',
                    'exercise.A', 'exercise.B', 'exercise.C', 'exercise.D', 'exercise.E',
                    'exercise.F', 'exercise.topic', 'exercise.answer' , 'exercise.qid',
                    'wrong.userName', 'wrong.level')
                ->orderByDesc('wrong.count')
                ->count();
        }
        else if ($mode == 'AI'){
            $result = DB::table('wrong')
                ->select('wrong.topic', DB::raw('SUM(wrong.count) as c'))
                ->where('wrong.userName', '=', $userName)
                ->groupBy('wrong.topic')
                ->orderByDesc(DB::raw('SUM(wrong.count)'))
                ->get();

            $count = DB::table('wrong')
                ->select('wrong.topic', DB::raw('SUM(wrong.count) as c'))
                ->where('wrong.userName', '=', $userName)
                ->groupBy('wrong.topic')
                ->orderByDesc(DB::raw('SUM(wrong.count)'))
                ->count();
        }

        /*this part is for showing answers */
        $flag1 = "undo";
        $score = 0;
        $res = array();
        $answers = array();
        if ($request->has('action') && $request->input('action') == 'done') {
            //Handle GET method
            $flag1 = "done";
            if ($request->has('result') && $request->has('answer')){
                $res = explode(" ", $request->input('result'));
                $answers = explode(" ", $request->input('answer'));
                for ($i = 0; $i < sizeof($res); $i++) {
                    if ($res[$i] == 'F') {
                        $res[$i] = "Your answer of last time is wrong!";
                    } else {
                        $res[$i] = "Your answer of last time is correct!";
                    }
                }
                return view('profile.test_wrong',[
                    'mode' => $request->input('mode'),
                    'score' => $request->input('score'),
                    'result' => $request->input('result'),
                    'flag1' => $flag1,
                    'res' => $res,
                    'answers' => $answers,
                ]);
            }
        }

        if ($count == 0) {
            return redirect()->back()->with('alert', 'You need to make some mistakes first!');
        }
        if ($count > 0 && $mode == 'AI') {
            $countByTopic = array();
            foreach ($result as $var) {
                $countByTopic[$var->topic] = (int)$var->c;
            }//每个topic对应的错误次数
            $total = 6;
            $topic = array(); //为用户选择所需的Topic
            $count_exe = 0;
            $sum_wrong = 0;
            foreach ($countByTopic as $x => $x_value) {
                $sum_wrong += $x_value; //总的错误次数
            }
            arsort($countByTopic);


            foreach ($countByTopic as $x => $x_value) {
                if ($sum_wrong > $total) {
                    $temp = (ceil($total * $x_value / $sum_wrong));//按比例分配
                } else {
                    $temp = $x_value;
                }
                if ($count_exe + $temp >= $total) {
                    $topic[$x] = $total - array_sum($topic);
                    break;
                } else {
                    $count_exe = (ceil($total * $x_value / $sum_wrong)) + $count_exe;
                    $topic[$x] = (ceil($total * $x_value / $sum_wrong));
                }
            }
            $result = "";
            foreach ($topic as $x => $x_value) {
                if ($result != "") {
                    $result = DB::table('exercise')
                        ->where('topic', $x)
                        ->limit($x_value)
                        ->union($result)
                        ->get();
                } else {
                    $result = DB::table('exercise')
                        ->where('topic', $x)
                        ->limit($x_value)
                        ->get();
                }
            }
        }


        return view('profile.test_wrong',[
            'mode' => $mode,
            'score' => $score,
            'result' => $result,
            'flag1' => $flag1,
            'res' => $res,
            'answers' => $answers,
        ]);
    }

    public function test_updateWrongValidate(Request $request){
        $count = 0;
        if (Cookie::has('username')){
            $userName = Cookie::get('username');
            $mode = $request -> input('mode');
            if ($request->has('mode')){
                $mode=$request->get('mode');
            }
            $grade=array();
            $answer=array();
            $score=0;
            $index=0;
            foreach ($request as $k => $va){
                $arr = explode('_',$k);
                if (count($arr) > 1){
                    $key=$arr[1];
                    $type=$arr[0];

                    if ($type=='MCQ' or $type=='BLANK'){
                        if ($type=='MCQ'){
                            $val=implode($va);}
                        else{
                            $val=$va;
                        }
                        $result = DB::table('exercise')
                            ->where([['qid', '=', $key],['answer', '=', $val]])->get();
                        $ans = DB::table('exercise')
                            ->where(['qid', '=', $key])
                            ->select('answer')
                            ->first();
                        $answer[$index]=$ans->answer;
                        if ($result->count() >0) {
                            $grade[$index]='T';
                            $score=$score+10;
                        }
                        else {
                            $grade[$index]='F';

                            //update the db
                            $count = DB::table('wrong')
                                ->where([['qid', '=', $key],['userName', '=', $userName]])
                                ->count();
                            if ($count > 0){
                                $result_1_result=DB::table('wrong')
                                    ->where([['qid', '=', $key],['userName', '=', $userName]])
                                    ->first();
                                $count=$result_1_result['count']+1;
                                DB::table('wrong')
                                    ->where([['userName', '=', $userName], ['qid', '=', $key]])
                                    ->update(['count' => $count]);
                            }
                            else{
                                $result_2_result = DB::table('wrong')
                                    ->where(['qid', '=', $key])->first();
                                DB::table('wrong')->insert(
                                    ['userName' => $userName, 'qid' => $key,
                                        'count' => 1, 'topic' => $result_2_result->topic,
                                        'level' => $result_2_result->level]
                                );
                            }
                        }
                    }
                    else if ($type=='SCQ') {
                        $val=$va;
                        if ($val=='A'or $val=='B' or $val=='C' or $val=='D'or $val=='E'or $val=='F'){
                            $result = DB::table('exercise')
                                ->where([['qid', '=', $key], ['answer', '=', $val]])->get();
                            $ans = DB::table('exercise')
                                ->where(['qid', '=', $key])
                                ->select('answer')
                                ->first();
                            $answer[$index]=$ans->answer;

                            if ($result -> count() > 0) {
                                $score=$score+10;
                                $grade[$index]='T';
                            }
                            else {
                                $grade[$index]='F';

                                //update the db
                                $count = DB::table('wrong')
                                    ->where([['qid', '=', $key],['userName', '=', $userName]])
                                    ->count();
                                if ($count > 0){
                                    $result_1_result=DB::table('wrong')
                                        ->where([['qid', '=', $key],['userName', '=', $userName]])
                                        ->first();
                                    $count=$result_1_result['count']+1;
                                    DB::table('wrong')
                                        ->where([['userName', '=', $userName], ['qid', '=', $key]])
                                        ->update(['count' => $count]);
                                }
                                else{
                                    $result_2_result = DB::table('wrong')
                                        ->where(['qid', '=', $key])->first();
                                    DB::table('wrong')->insert(
                                        ['userName' => $userName, 'qid' => $key,
                                            'count' => 1, 'topic' => $result_2_result->topic,
                                            'level' => $result_2_result->level]
                                    );
                                }
                            }
                        }
                    }
                    $index=$index+1;
                }
            }
            $result=implode("+",$grade);
            $ans=implode("+",$answer);

            //Get request
            return redirect()->route('profile/test_wrong',
                ['action' => 'down', 'result' => $result,
                'score' => $score, 'answer' => $ans, 'mode' => $mode,
                    'count' => $count]);
        }
        else{
            return view('profile');
        }
    }

    public function testAuth($id){
        if (Cookie::has('username')){
            $username = Cookie::get('username');
            $user = DB::table('users')->where('userName', $username)->first();
            if ($user->learnprogress >= $id - 1){
                return view('test'.$id);
            }else{
                return redirect()->back()->with('alert', 'You need to finish test '.$id." first!");
            }
        }
        else{
            return view('profile');
        }
    }

}