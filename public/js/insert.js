function swap(i,j,array){
    var temp = array[j];
    array[j] = array[i];
    array[i] = temp;
}

function draw(arr){
    var canvas = document.getElementById('myCanvas');
    var ctx = canvas.getContext('2d');
    var lengthWidth = canvas.height;
    var width = 20;
    var space =20;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.font = "18px serif";
    for (var i = 0; i < arr.length; i++) {
        ctx.fillStyle = '#61C5FE';
        ctx.fillRect(i * (width+space), lengthWidth - arr[i], width, arr[i]);
        ctx.fillStyle = '#240be4';
        ctx.fillText(arr[i], i * (width+space), lengthWidth - arr[i]-5);
    }
}
/*
FUNCTION NAME: draw
WRITER: Liu Botao
DATE:18/04/2019
INPUT PARAMETER: arr(array)
RETURN VALUE: No RETURN
DISCRIPTION:
Convert the input array to a pillar diagram using canvas
*/

function animation(tempArr) {
    var interval =1000;

    tempArr.forEach((item, index) => {
        setTimeout(() => draw(item), index * interval);
    });
}

/*
  FUNCTION NAME: draw
  WRITER: Liu Botao
  DATE:18/04/2019
  INPUT PARAMETER: tempArr(array)
  RETURN VALUE: No RETURN
  DISCRIPTION:
  variable interval is the dalay time between conversions
  input array should be a 2d array
  2d array will be separated into 1d sub arrays, and each of them represents one step of the operation
  */

function sortNumber(a,b)
{
    return a - b;
}
/*
FUNCTION NAME: draw
WRITER: Liu Botao
DATE:18/04/2019
INPUT PARAMETER: a,b
RETURN VALUE: a-b
DISCRIPTION:
Function that makes the sort function sort the numbers according to their values instead of the first character
*/

function insertSort(arr){

    var tempArr = [arr.slice()];
    var num = arr.length;

    for (var i=2;i<num;i++){
        var front=arr.slice(0,i);
        var back=arr.slice(i,num);
        var a =front.sort(sortNumber);
        a=a.concat(back);
        tempArr.push(a);

    }
    tempArr.push(arr.sort(sortNumber));
    animation(tempArr);
}

/*
FUNCTION NAME: draw
WRITER: Liu Botao
DATE:18/04/2019
INPUT PARAMETER: a,b
RETURN VALUE: a-b
DISCRIPTION:
Sort the array using the insert method
*/



function bubbleSort(arr) {


    var tempArr = [arr.slice()];
    var length = arr.length;
    for (var i = 0; i < length; i++) {
        var done = true;
        for (var j = 0; j < length - i; j++) {
            if (arr[j] > arr[j + 1]) {
                var temp = arr[j];
                arr[j] = arr[j + 1];
                arr[j + 1] = temp;
                done = false;
                tempArr.push(arr.slice());
            }
        };
        if(done){
            break;
        };
    }
    animation(tempArr);
}
/*
FUNCTION NAME: draw
WRITER: Liu Botao
DATE:18/04/2019
INPUT PARAMETER: a,b
RETURN VALUE: a-b
DISCRIPTION:
Sort the array using the bubble method
*/

function countSort(arr){
    var tempArr = [arr.slice()];
    var length = arr.length;
    var halflength=length/2;
    var tem2=new Array();
    var tem1=new Array();
    if (length%2){
        for (var i=0;i<halflength-1;i++){
            var max=0;
            var maxe=0;
            var min=100;
            var mine=0;
            for (var j=0;j<=length-2*i;j++){
                if(arr[j]<min){
                    min=arr[j];
                    mine=j;
                }
                if(arr[j]>max){
                    max=arr[j];
                    maxe=j;
                }
            }
            tem1[i]=min;
            if(i==0){
                tem2[i]=max;
            }
            else{
                tem2.unshift(max);
            }
            arr.splice(maxe,1);
            if (maxe<mine){
                arr.splice(mine-1,1);
            }
            else{
                arr.splice(mine,1);
            }
            var a=tem1.concat(arr);
            a=a.concat(tem2);
            tempArr.push(a);
        }}
    else{
        for (var i=0;i<halflength;i++){
            var max=0;
            var maxe=0;
            var min=100;
            var mine=0;
            for (var j=0;j<=length-2*i;j++){
                if(arr[j]<min){
                    min=arr[j];
                    mine=j;
                }
                if(arr[j]>max){
                    max=arr[j];
                    maxe=j;
                }
            }
            tem1[i]=min;
            if(i==0){
                tem2[i]=max;
            }
            else{
                tem2.unshift(max);
            }
            arr.splice(maxe,1);
            if (maxe<mine){
                arr.splice(mine-1,1);
            }
            else{
                arr.splice(mine,1);
            }
            var a=tem1.concat(arr);
            a=a.concat(tem2);
            tempArr.push(a);
        }}
    animation(tempArr);

}

function selectSort(arr) {
    var tempArr = [arr.slice()];
    var length = arr.length
    var front=[];
    for(var i=0;i<length;i++)
    {
        var min=100;
        var mine=0;

        for (var j=0;j<length;j++){
            if (arr[j]<=min)
            {
                min=arr[j];
                mine=j;
            }
        }
        arr.splice(mine,1);
        front.push(min);
        var a=front.concat(arr);
        tempArr.push(a);
    }
    animation(tempArr);

}

function shellSort(arr) {
    var tempArr = [arr.slice()];
    const len = arr.length;
    let gap = Math.floor(len / 2);

    while (gap > 0) {
        for (let i = gap; i < len; i++) {
            const temp = arr[i];
            let preIndex = i - gap;

            while (arr[preIndex] > temp) {
                arr[preIndex + gap] = arr[preIndex];
                preIndex -= gap;
                var c=arr.slice();
                tempArr.push(c);
            }
            arr[preIndex + gap] = temp;
            let b=arr.slice();
            tempArr.push(b);
        }
        gap = Math.floor(gap / 2);
    }
    let a=arr.slice();
    tempArr.push(a);
    animation(tempArr);

}