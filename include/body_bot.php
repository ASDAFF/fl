<?

if (defined('PROD_ZONE') && PROD_ZONE === true)
{
?>
    <a href="#elFormPhone" class="elPhoneBtn popup-inline" data-rel="magnific-popup-link">
        <div class="circlephone" style="transform-origin: center;"></div>
        <div class="circle-fill" style="transform-origin: center;"></div>
        <div class="img-circle" style="transform-origin: center;">
            <div class="img-circleblock" style="transform-origin: center;"></div>
        </div>
    </a>
    <div class="engFormPopup zwhite-popup" id="elFormPhone">
        <form>
            <div class="elOrderPopup-pole">
                <div class="it-block">
                    <div class="it-title">Имя*</div>
                    <input name="NAME" type="text" placeholder="Ваше Имя" value="" required="" title="Ваше Имя">
                </div>
                <div class="it-block">
                    <div class="it-title">Телефон*</div>
                    <input name="PHONE" type="text" placeholder="Ваш телефон" value="" required="" title="Ваш телефон">
                </div>
            </div>
            <div class="result"></div>
            <div class="elFormPhone-btn">
                <button type="submit">Заказать звонок</button>
            </div>
        </form>
    </div>
    <!-- BEGIN JIVOSITE CODE {literal} -->
    <script type='text/javascript'>
        (function(){ var widget_id = 'SSmNZWmxDG';var d=document;var w=window;function l(){
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
    <!-- {/literal} END JIVOSITE CODE --><?
}