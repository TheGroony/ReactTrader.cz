const directionButton = document.querySelector("#directionButton");
const isShort = document.querySelector("#isShort");
const tickerInput = document.querySelector("#tickerInput");
const stockRadioButtons = document.querySelectorAll(".stockClass");
const stocksDiv = document.querySelector(".stocks");
const doneTradeForm = document.querySelector(".doneTrade");
const accountDepositForm = document.querySelector(".accountDeposit");
const formType = document.querySelectorAll(".formType");

for (i = 0; i < formType.length; i++) {
    formType[i].addEventListener("click", (ev) => {
        if(ev.target.dataset.type === "deposit") {
            doneTradeForm.style.display = "none";
            stocksDiv.style.opacity = "0.5";
            stockRadioButtons.forEach((button) => {
                button.disabled = true;
            });
            accountDepositForm.style.display = "flex";
        }
        else {
            accountDepositForm.style.display = "none";
            doneTradeForm.style.display = "flex";
            stocksDiv.style.opacity = "1";
            stockRadioButtons.forEach((button) => {
                button.disabled = false;
            });
        }
    });
}


for (i = 0; i < stockRadioButtons.length; i++) {
    stockRadioButtons[i].addEventListener("click", (button) => {
        button.checked = true;
        let ticker = button.target.dataset.ticker;
        if(ticker !== "OWN") {
            tickerInput.value = ticker;
            tickerInput.readOnly = true;
        }
        else {
            tickerInput.value = "";
            tickerInput.readOnly = false;
        }
    });
}


directionButton.addEventListener("click", () => {
    if (isShort.checked) {
        directionButton.value = "LONG";
        directionButton.style.backgroundColor = "yellowgreen";
        isShort.checked = false;
    } else {
        directionButton.value = "SHORT";
        directionButton.style.backgroundColor = "#C90000";
        isShort.checked = true;
    }
});