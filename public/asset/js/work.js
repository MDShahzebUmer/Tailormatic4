/*** REQUIRE : common.js ***/
/* ----------------------------------------------------------------
 * PAGE LOADING
 * ----------------------------------------------------------------
 */




window.addEventListener('DOMContentLoaded', function() {
    var images = document.getElementsByTagName('img')
      , html = document.getElementsByTagName("html")[0]
      , body = document.getElementsByTagName("body")[0]
      , preloading_percent = document.getElementById('preloading-percent')
      , preloading = document.getElementById('preloading')
      , percent = 0
      , success = 0;
    if (images.length !== 0)
    {
        setElementStyle([html, body], {
            width: "100%",
            height: "100%",
            minWidth: "560px"
        });
        for (var index in images)
        {
            if (images.hasOwnProperty(index) && index < images.length)
            {
                images[index].onload = function() {
                    percent = Math.min(100, Math.max(0, Math.round((100 / images.length) * ++success)));
                    if (percent === 100) 
                    {
                        preloading_percent.innerHTML = '99%';
                        preloading.style.width = '99%';
                    }
                    else {
                        preloading_percent.innerHTML = percent + '%';
                        preloading.style.width = percent + '%';
                    } 
                };
            }
        }
    }
    else {
        // DO STUFF WHEN NOT FOUND IMAGE ON HTML
    }
}, false);
/* ----------------------------------------------------------------
 * EFFECT ADDITION
 * ----------------------------------------------------------------
 */
window.addEventListener('load', function() {
    var html = document.getElementsByTagName("html")[0]
      , body = document.getElementsByTagName("body")[0]
      , preloading_percent = document.getElementById('preloading-percent')
      , preloading = document.getElementById('preloading')
      , preload = document.getElementById('preload')
      , elm = document.getElementById('shirt')
      , masthead = document.getElementById('masthead')
      , container = document.getElementById('container')
      , mix_n_match = document.getElementById('mix-n-match')
      , cuff_3d = document.getElementById('cuff-3d')
      , gusset = document.getElementById('gusset-patch')
      , high_quality_collar = document.getElementById('high-quality-collar')
      , button = document.getElementById('button')
      , monogram = document.getElementById('monogram')
      , mastfooter = document.getElementById('mastfooter');
    // SET PAGE LOADING PERCENTAGE, THEN PRELOAD SUCCESS AFTER 1 SECOND
    preloading_percent.innerHTML = '100%';
    preloading.style.width = '100%';
    setTimeout(function(){
        preload.setAttribute('class', 'success');
    }, 1000);
    // BROWSER DETECTION
    if (navigator.userAgent.toLowerCase().match(/msie/i))
    {
        setTimeout(function(){
            // REMOVE DOM HTML AND BODY INLINE STYLE
            removeAttrStyle([html, body]);
            // REMOVE PRELOAD
            preload.remove();
            elm.setAttribute('class', 'ie');
        }, 1500);
    }
    else {
        setTimeout(function(){
            // REMOVE DOM HTML AND BODY INLINE STYLE
            removeAttrStyle([html, body]);
            // REMOVE PRELOAD
            preload.remove();
            // SET EFFECT RUNNING
            elm.setAttribute('class', 'running');
            // MODERN BROWSER ONLY
            elementAppear(masthead.childNodes.item(1), 'fadeInDown', 0);
            elementAppear(masthead.childNodes.item(3), 'fadeIn', 500);
            elementAppear(container, 'fadeIn', 1000);
            elementAppear(mix_n_match, 'fadeIn', 2000);
            elementAppear(cuff_3d, 'fadeIn', 4000);
            elementAppear(gusset, 'fadeIn', 6000);
            elementAppear(high_quality_collar, 'fadeIn', 8000);
            elementAppear(button, 'fadeIn', 10000);
            elementAppear(monogram, 'fadeIn', 12000);
            elementAppear(mastfooter, 'fadeIn', 14000);
        }, 1500);
    }
}, false);