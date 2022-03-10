// エラーメッセージ配列
let errorMes = ["入力必須です","メールアドレスを入力してください", "日付を入力してください","タイトルを入力してください"];
console.log("iiid");
function cancelsubmit() {
    for(let i=0;i<=3;i++){
    if(document.getElementsByClassName("inputs")[i].value == '') {
        document.getElementsByClassName("alertText")[i].textContent = errorMes[i];
        console.log("iiid");
        if(i == 3){
            return false;
        }
    }
  }
}
