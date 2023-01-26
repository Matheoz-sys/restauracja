const statusButtons = document.querySelectorAll(".status-button");

function changeStatusText(id, text) {
  const statusText = document.getElementById(`status${id}`);
  statusText.textContent = text;
}

function showDeleteButton(id) {
  const delteOrder = document.getElementById(`delete${id}`);
  delteOrder.classList.remove("confirm-hidden");
}

function changeStatusButton(button, id) {
  if (button.textContent === "Dostarczono") {
    button.parentElement.parentElement.classList.remove("order-ready");
    button.parentElement.parentElement.classList.add("order-delivered");

    showDeleteButton(id);
    changeStatusText(id, "Status: dostarczono");
    button.classList.add("confirm-hidden");
  } else {
    changeStatusText(id, "Status: gotowe");
    button.textContent = "Dostarczono";
  }
}

statusButtons.forEach((button) => {
  button.addEventListener("click", (event) => {
    changeStatusButton(button, event.target.id);
    button.parentElement.parentElement.classList.add("order-ready");
  });
});

////////////////////////
/////// Dragging ///////
////////////////////////

const draggables = document.querySelectorAll(".draggable");
const containers = document.querySelectorAll(".order-list-ul");

draggables.forEach((draggable) => {
  draggable.addEventListener("dragstart", () => {
    draggable.style.backgroundColor = "lightgray";
    draggable.classList.add("dragging");
  });

  draggable.addEventListener("dragend", () => {
    draggable.style.backgroundColor = "white";
    draggable.classList.remove("dragging");
  });
});

containers.forEach((container) => {
  container.addEventListener("dragover", (e) => {
    e.preventDefault();
    const afterElement = getDragAfterElement(container, e.clientY);
    const draggable = document.querySelector(".dragging");
    if (afterElement == null) {
      container.appendChild(draggable);
    } else {
      container.insertBefore(draggable, afterElement);
    }
  });
});

function getDragAfterElement(container, y) {
  const draggableElements = [
    ...container.querySelectorAll(".draggable:not(.dragging)"),
  ];
  return draggableElements.reduce(
    (closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    },
    { offset: Number.NEGATIVE_INFINITY }
  ).element;
}
