<link rel="stylesheet" type="text/css" href="{{config('app.ad_url')}}/static/ad/ad.css" />
<script src="{{config('app.ad_url')}}/static/ad/ad.js"></script>
<div id="adContainer" class="ad-container"></div>
<script>
    // 调用 loadAd 函数并传入广告位容器的ID和广告数据的URL
    loadAd('adContainer', '{{config('app.ad_url')}}/api/ad?adzone_id={{config('app.adzone_id')}}');
</script>