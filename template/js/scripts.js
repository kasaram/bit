function stpad(a) {var str = ""+a;return "00".substring(0, "00".length - str.length) + str;}

// TIMER CLASS (selector , seconds)
function countdowner(el, sec) {
  var timer = sec;var elem = $(el);  var goes = false;
  function sshowt(a) {elem.html(stpad(Math.floor(a/60)) + ':' +  stpad(a % 60));}
  sshowt(timer);
  this.tick = function() {if(goes) {if(--timer<0) {location.reload();} else {sshowt(timer);}}}
  this.start = function() {goes = true;}
  setInterval(this.tick, 1000);
}

$(document).on('click','#takecoins',function(){
$('#takecoins').hide();
$('#claimcaptchaform').show();
});

function scrolldown() {$('html, body').stop().animate({scrollTop:($('#footer').offset().top)}, 1000);}

// FOR IFRAME
// $(window).load(function () {
//   $('#mframe').contents().find("body").on('click', function(e) {
//   e = e || event;
//   if(e.target.nodeName!='BODY' && e.target.nodeName!='SPAN' && e.target.nodeName!='DIV') {
//     tessw.start();
//     $.get('/bonus/start/?clickStart',function(a){ $('#bonusacts>div:eq(0)').html(a); });
//   }
//   });
// });

$(document).on('click','#mframe', function(e) {
  e = e || event;
  if(e.target.nodeName!='BODY' && e.target.nodeName!='SPAN') {
    tessw.start();
    $.get('/bonus/start/?clickStart',function(a){ location.reload();});

  }
});
$(window).load(function () {$('#mframe a').attr('target','_blank');});


//проверка на Addblock
  function checkAdb() {
    if($('#ad-detect').css('display') == 'none'){
      $('.content').html('');
      $('.content:eq(0)').html('<div style="text-align:center; font-weight:bold;"><h2>Please, disable a program that blocks ads, and reload the page!<h2/><a href="/">RELOAD THE PAGE</a></div>');
    }
  }
  setTimeout("checkAdb()", 2000);