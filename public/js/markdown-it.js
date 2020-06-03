var md = require('markdown-it')();
var result = md.render('## markdown-it rulezz!');
console.log(result)
document.getElementById("demo").innerHTML = result;
