let es = document.querySelectorAll(".popover")

es.forEach(e => {
     e.addEventListener('click', () => {
          if (e.dataset.on == "0") {
               e.parentElement.firstElementChild.style.display = "block"
          	e.dataset.on = "1"
          }
          else {
               e.parentElement.firstElementChild.style.display = "none"
               e.dataset.on = "0"
          }
     })
})