// console.log('user-page-line');
function elementsWidth(){
  // 1 элемент
  if(document.documentElement.clientWidth < 510) {
    let elWidth = 5 + 'px';
    lineStep1[0].style.width = elWidth;
  } else {
    let elWidth = (document.documentElement.clientWidth - 510);
    if (elWidth < 5) {elWidth = 5;}
    if (elWidth > 20) {elWidth = 20;}
    lineStep1[0].style.width = elWidth + 'px';
  }
  // 3 элемент
  let elStart = lineStep3[0].getBoundingClientRect().x + lineStep3[0].getBoundingClientRect().width;
  let elWidth = (elStart - 10);
  if (elWidth < 5) {elWidth = 5;}
  if (elWidth > 400) {elWidth = 400;}
  lineStep3[0].style.width = elWidth + 'px';
  // 4 элемент
  if(radio1.checked) {
    let elHeight = 125;
    lineStep4[0].style.height = elHeight + 'px';
  }
  if(radio2.checked) {
    let elHeight = 185;
    lineStep4[0].style.height = elHeight + 'px';
  }
  if(radio3.checked) {
    let elHeight = 250;
    lineStep4[0].style.height = elHeight + 'px';
  }
  // 5 элемент
  if(document.documentElement.clientWidth < 1100) {
    let elStart = lineStep5[0].getBoundingClientRect().x + lineStep3[0].getBoundingClientRect().width;
    let elWidth = (document.documentElement.clientWidth - 20);
    if (elWidth < 5) {elWidth = 5;}
    //if (elWidth > 1100) {elWidth = 1100;}
    lineStep5[0].style.width = elWidth + 'px';
  }
  // 6 элемент
  if(radio1.checked) {
    let endButtonStart = (lineEnd[0].getBoundingClientRect().top + window.pageYOffset);
    let endButtonEnd = (lineEnd[0].getBoundingClientRect().bottom + window.pageYOffset);
    let buttonCenter = ((lineEnd[0].getBoundingClientRect().bottom + window.pageYOffset) - (lineEnd[0].getBoundingClientRect().top + window.pageYOffset)) / 2;
    let elStartPosition = (lineStep6[0].getBoundingClientRect().top + window.pageYOffset);
    let elHeight = endButtonStart - elStartPosition + buttonCenter;
    lineStep6[0].style.height = elHeight + 'px';
  }
  if(radio2.checked) {
    let endButtonStart = (lineEndEl[0].getBoundingClientRect().top + window.pageYOffset);
    let endButtonEnd = (lineEndEl[0].getBoundingClientRect().bottom + window.pageYOffset);
    let buttonCenter = ((lineEndEl[0].getBoundingClientRect().bottom + window.pageYOffset) - (lineEndEl[0].getBoundingClientRect().top + window.pageYOffset)) / 2;
    let elStartPosition = (lineStep6[0].getBoundingClientRect().top + window.pageYOffset);
    let elHeight = endButtonStart - elStartPosition + buttonCenter;
    lineStep6[0].style.height = elHeight + 'px';
  }
  if(radio3.checked) {
    let endButtonStart = (lineEnd[1].getBoundingClientRect().top + window.pageYOffset);
    let endButtonEnd = (lineEnd[1].getBoundingClientRect().bottom + window.pageYOffset);
    let buttonCenter = ((lineEnd[1].getBoundingClientRect().bottom + window.pageYOffset) - (lineEnd[1].getBoundingClientRect().top + window.pageYOffset)) / 2;
    let elStartPosition = (lineStep6[0].getBoundingClientRect().top + window.pageYOffset);
    let elHeight = endButtonStart - elStartPosition + buttonCenter;
    lineStep6[0].style.height = elHeight + 'px';
  }
  // 7 элемент
  if(radio1.checked) {
    let endButtonStart = lineEnd[0].getBoundingClientRect().left;
    let endButtonWidth = lineEnd[0].getBoundingClientRect().width;
    let buttoEndPosition = endButtonStart + endButtonWidth;
    let elStartPosition = lineStep7[0].getBoundingClientRect().left;
    let elEndPosition = elStartPosition + lineStep7[0].getBoundingClientRect().width;
    let elWidth = elEndPosition - buttoEndPosition;
    lineStep7[0].style.width = elWidth + 'px';
  }
  if(radio2.checked) {
    let endButtonStart = lineEndEl[0].getBoundingClientRect().left;
    let endButtonWidth = lineEndEl[0].getBoundingClientRect().width;
    let buttoEndPosition = endButtonStart + endButtonWidth;
    let elStartPosition = lineStep7[0].getBoundingClientRect().left;
    let elEndPosition = elStartPosition + lineStep7[0].getBoundingClientRect().width;
    let elWidth = elEndPosition - buttoEndPosition;
    lineStep7[0].style.width = elWidth + 'px';
  }
  if(radio3.checked) {
    let endButtonStart = lineEnd[1].getBoundingClientRect().left;
    let endButtonWidth = lineEnd[1].getBoundingClientRect().width;
    let buttoEndPosition = endButtonStart + endButtonWidth;
    let elStartPosition = lineStep7[0].getBoundingClientRect().left;
    let elEndPosition = elStartPosition + lineStep7[0].getBoundingClientRect().width;
    let elWidth = elEndPosition - buttoEndPosition;
    lineStep7[0].style.width = elWidth + 'px';
  }
}

let lineStep1 = document.getElementsByClassName('step-1'); // линия step-1
let lineStep2 = document.getElementsByClassName('step-2'); // линия step-2
let lineStep3 = document.getElementsByClassName('step-3'); // линия step-3
let lineStep4 = document.getElementsByClassName('step-4'); // линия step-4
let lineStep5 = document.getElementsByClassName('step-5'); // линия step-5
let lineStep6 = document.getElementsByClassName('step-6'); // линия step-6
let lineStep7 = document.getElementsByClassName('step-7'); // линия step-7

let radio1 = document.getElementById('user');
let radio2 = document.getElementById('foto');
let radio3 = document.getElementById('work');

let lineEnd =  document.querySelectorAll('input[type=submit]');; // кнопка - конец линий
let lineEndEl =  document.querySelectorAll('button[name=go-to-add-foto]');; // кнопка - конец линий

addEventListener("resize",  function(){elementsWidth(this)}, false); // активность линии при изменении размера страницы
addEventListener("load",  function(){elementsWidth(this)}, false); // активность при полной загрузке страницы
addEventListener("click",  function(){elementsWidth(this)}, false); // активность при полной загрузке страницы

/* image upload and preview */
jQuery(function() {
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				jQuery('.foto-space').addClass('foto-preview').css('background-image', 'url(' + e.target.result + ')');
			}

			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}
	
	jQuery('#file').change(function() {
		readURL(this);
	});
	
	jQuery(document).on('click', '.foto-preview label i', function (e) {
		jQuery('.foto-space').removeClass('foto-preview').css('background-image', 'none');
		e.preventDefault();
	});
});