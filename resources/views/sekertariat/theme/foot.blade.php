</div>
<div id="eis_footer"></div>
</div>
</div>
<div id="eis_onloading" style="display: none;">&nbsp;</div>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" charset="utf-8"></script>
<script src="{{url('')}}/public/assets/main/main.js" charset="utf-8"></script>
@foreach ($js as $val)
<script src="{{ $val }}"></script>
@endforeach
</html>
