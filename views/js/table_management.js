let occupiedPlaces = document.querySelector(".occupiedPlaces");
let order = document.querySelector(".order-button");
console.log(order);

function changeButtonState() {
    switch (occupiedPlaces.innerText) {
        case 0:
        case "0":
            console.log("0?");
            order.classList.add("blocked");
            order.setAttribute("disabled", true);
            break;
        default:
            order.classList.remove("blocked");
            order.setAttribute("disabled", false);
    }
}

async function addPersonToTable() {
    await fetch("/restauracja/addPersonToTable/" + occupiedPlaces.dataset.id)
        .then((el) => el.json())
        .then((el) => {
            occupiedPlaces.innerText = el.occupiedPlaces;
            changeButtonState();
        })
        .catch((el) => console.log(el));
}

async function removePersonFromTable() {
    await fetch(
        "/restauracja/removePersonFromTable/" + occupiedPlaces.dataset.id
    )
        .then((el) => el.json())
        .then((el) => {
            occupiedPlaces.innerText = el.occupiedPlaces;
            changeButtonState();
        });
}

changeButtonState();
