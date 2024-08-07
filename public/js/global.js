const ErrMsg = document.querySelector('.err-msg span')
const Inputs = document.querySelectorAll('input')

for (let elem in Inputs) {
	Inputs[elem].addEventListener('change', () => (ErrMsg.innerText = ''))
}
