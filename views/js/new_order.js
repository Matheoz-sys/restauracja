const orderButton = document.getElementById("order-button");
const plusButtons = document.querySelectorAll(".add-to-order-button");
const minusButtons = document.querySelectorAll(".minus-order-button");
const modalWindow = document.getElementById("modal-window");
const orderDetail = document.getElementById("order-detail");

const order = {
  meals: {},
};

function setDataToSend() {
  orderDetail.value = JSON.stringify(order);
  console.log(orderDetail.value);
}

orderButton.addEventListener("click", () => {
  console.log("zamawiam");
  console.log(order);
  setDataToSend();
  showModal();
});

function showModal() {
  modalWindow.classList.add("confirm-visible");
  modalWindow.classList.remove("confirm-hidden");
}

function hiddenModal() {
  modalWindow.classList.add("confirm-hidden");
  modalWindow.classList.remove("confirm-visible");
}

function showAmount(spanId, amount) {
  const currentSpan = document.getElementById(`span${spanId}`);
  currentSpan.textContent = amount;
}

function addToOrder(mealId) {
  if (order.meals.hasOwnProperty(mealId)) {
    order.meals[mealId]["amount"]++;
  } else {
    order.meals[mealId] = { mealId: mealId, amount: 1 };
  }
  showAmount(mealId, order.meals[mealId]["amount"]);
}

plusButtons.forEach((element) => {
  element.addEventListener("click", (event) => {
    addToOrder(event.target.id);
  });
});

function minusOrder(mealId) {
  if (order.meals.hasOwnProperty(mealId)) {
    if (order.meals[mealId]["amount"] >= 1) {
      order.meals[mealId]["amount"]--;
      showAmount(mealId, order.meals[mealId]["amount"]);
    }
    if (order.meals[mealId]["amount"] == 0) {
      delete order.meals[mealId];
    }
  }
}

minusButtons.forEach((element) => {
  element.addEventListener("click", (event) => {
    minusOrder(event.target.id);
  });
});

modalWindow.addEventListener("click", () => {
  hiddenModal();
});
