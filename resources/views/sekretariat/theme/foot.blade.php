</div>
<div id="eis_footer"></div>
</div>
</div>
<div id="eis_onloading" style="display: none;">&nbsp;</div>
</body>
{!!(stylePack())["js"]!!}
@foreach ($js as $val)
<script src="{{ $val }}"></script>
@endforeach
</html>
