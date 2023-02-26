<div id="tagcloud">
    @foreach ($keys as $key)
        <a href="#" rel="{{$key->count * 0.01}}">{{$key->key}}</a>
    @endforeach
</div>
<script>
    $("#tagcloud a").tagcloud({
        size: {
            start: 12,
            end: 55,
            unit: "px"
        },
        color: {
            start: '#55FDF3',
            end: '#9F55FD'
        }
    });
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>