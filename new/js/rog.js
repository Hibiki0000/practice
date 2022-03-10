// エラーメッセージ配列
let errorMes = ["IDを入力してください", "Passwordを入力してください", "メールアドレスを入力してください"];
function cancelsubmit() {
    for(let i=0;i<=2;i++){
    if(document.getElementsByClassName("inputs")[i].value == '') {
        document.getElementsByClassName("alertText")[i].textContent = errorMes[i];
        if(i == 2){
            return false;
        }
    }
  }
}

