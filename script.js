// let priorities = document.querySelectorAll(".priority");

// priorities.forEach((priority) => {
//   const priorityValue = priority.dataset.priority;

//   if (priorityValue === "low") {
//     priority.classList.add("priority_low_bg");
//   } else if (priorityValue === "mid") {
//     priority.classList.add("priority_mid_bg");
//   } else if (priorityValue === "high") {
//     priority.classList.add("priority_high_bg");
//   }
// });

document.addEventListener("DOMContentLoaded", () => {
    let priorities = document.querySelectorAll(".priority");

    priorities.forEach((priority) => {
        const priorityValue = priority.dataset.priority;

        if (priorityValue === "Low") {
            priority.style.backgroundColor = "#13c16d"
        } else if (priorityValue === "Medium") {
            priority.style.backgroundColor = "#ffc107"
        } else if (priorityValue === "High") {
            priority.style.backgroundColor = "#dc3545"
        }
    });
});


// const taskToggleBtn = document.getElementById('taskToggleBtn');
const card = document.getElementById('newtask_card');
let tasktoggle = () => {
    console.log("sdsds")
    card.classList.toggle('hidden');
}



////header toggling
let container = document.getElementById("container")
let header = document.getElementById("header")
let lastScrollTop = 0;
document.addEventListener("DOMContentLoaded", function() {
    header.style.top = 0
});
container.onscroll = function() {
    const scrollTop = container.scrollTop;
    const windowHeight = container.clientHeight;
    const contentHeight = container.scrollHeight;

    if (scrollTop === 0) {
        // User is at the top of the container
        header.style.top = 0
    } else if (scrollTop + windowHeight === contentHeight) {
        // User is at the bottom of the container
        header.style.top = 0
    } else if (scrollTop > lastScrollTop) {
        // User is scrolling down
        header.style.top = -85 + "px";
    } else {
        // User is scrolling up
        header.style.top = 0;
    }

    lastScrollTop = scrollTop;
};


//edit btn toggle
// Edit btn toggle
let editbtns = document.querySelectorAll('.editbtn');

editbtns.forEach(editbtn => {
    let editForm = editbtn.closest('tr').nextElementSibling; // Find the closest 'tr' and then get the next sibling
    editbtn.addEventListener("click", () => {
        editForm.style.display = editForm.style.display === 'contents' ? 'none' : 'contents';
    });
});
