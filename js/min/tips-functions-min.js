function focusOnInput(){var e=document.getElementById("your-name");e.focus()}function jumptosuggestie(){for(var e=document.getElementsByTagName("a"),n=0,t=e.length;t>n;n++){var o=e[n];o.href.indexOf("#reactieformulier")>0&&(o.addEventListener("click",function(e){e.preventDefault()}),o.addEventListener("click",focusOnInput,!1))}}function addLoadEvent(e){var n=window.onload;"function"!=typeof window.onload?window.onload=e:window.onload=function(){n(),e()}}document.getElementsByClassName=function(e){for(var n=[],t=new RegExp("\\b"+e+"\\b"),o=this.getElementsByTagName("*"),a=0;a<o.length;a++){var u=o[a].className;t.test(u)&&n.push(o[a])}return n},addLoadEvent(jumptosuggestie);