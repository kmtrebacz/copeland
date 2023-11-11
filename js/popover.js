let popoverButtons = document.querySelectorAll(".popover")

popoverButtons.forEach(popoverButton => {
	popoverButton.addEventListener('click', () => {
		if (popoverButton.dataset.on == "0") {
			popoverButton.parentElement.firstElementChild.style.display = "block"
			popoverButton.dataset.on = "1"
		}
		else {
			popoverButton.parentElement.firstElementChild.style.display = "none"
			popoverButton.dataset.on = "0"
		}
	})
})