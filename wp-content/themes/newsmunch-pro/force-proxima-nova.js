/* Forzar proxima-nova en todo el sitio excepto iconos Font Awesome */
(function() {
  var fontFamily = "'proxima-nova', Arial, sans-serif";
  var excludeClasses = ["fa", "fas", "fab", "far", "fal", "fad"];
  var excludeSelector = excludeClasses.map(function(c) { return "."+c+", i[class*='fa-']"; }).join(", ");
  var all = document.querySelectorAll('body *:not(' + excludeSelector + ')');
  for (var i = 0; i < all.length; i++) {
    all[i].style.setProperty('font-family', fontFamily, 'important');
  }
})();
