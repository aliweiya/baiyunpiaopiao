@extends('pc.layout.base')
@section('content')
    <div id="Content">
        <div class="inner">
            {{--<div class="adbanner inner"><a href="https://www.liaogou168.com/merchant/detail/10008" target="_blank"><img src="/img/ad_1.jpg"><button class="close"></button></a></div>--}}
            <div id="Info">
                <p class="name">{{$match['lname']}}直播：{{$match['hname']}}&nbsp;&nbsp;VS&nbsp;&nbsp;{{$match['aname']}}</p>
                <p class="line">
                <?php $channels = $live['channels']; ?>
                    @foreach($channels as $index=>$channel)
                        <?php
                        if ($channel['type'] == 3 || $channel['type'] == 1 || $channel['type'] == 2 || $channel['type'] == 7)
                            $preUrl = str_replace("https://","http://",env('APP_URL'));
                        else if($channel['type'] == 99){
                            if ($channel['player'] == 11){
                                $preUrl = str_replace("https://","http://",env('APP_URL'));
                            }
                            else{
                                if (stristr($channel['link'],'player.pptv.com')){
                                    $preUrl = str_replace("https://","http://",env('APP_URL'));
                                }
                                else{
                                    $preUrl = str_replace("http://","https://",env('APP_URL'));
                                }
                            }
                        }
                        else
                            $preUrl = str_replace("http://","https://",env('APP_URL'));
                        ?>
                        <button id="{{$channel['channelId']}}" @if($show_live) onclick="ChangeChannel('{{$preUrl.'/live/player.html?cid='.$channel['id']}}', this)" @endif >{{$channel['name']}}</button>
                    @endforeach
                </p>
            </div>
            <div class="iframe" id="Video">
                @if($match['status'] == 0 && !$show_live)
                @elseif($show_live)
                @elseif($match['status'] == -1 && !$show_live)
                    {{--<p class="noframe"><img src="/img/pc/icon_matchOver.png">比赛已结束</p>--}}
            @endif
                <div class="ADWarm_RU" style="display: none;"><p onclick="document.getElementById('Video').removeChild(this.parentNode)">· 我知道了 ·</p></div>
            </div>
            <div class="share" id="Share">
                复制此地址分享：<input type="text" name="share" value="" onclick="Copy()"><span></span>
            </div>
        </div>
        {{--<div class="adbanner inner"><a href="http://91889188.87.cn" target="_blank"><img src="/img/ad_1.jpg"><button class="close"></button></a></div>--}}
        <div class="clear"></div>
    </div>
    {{--<div class="adflag left">--}}
        {{--<a href="http://91889188.87.cn" target="_blank"><img src="/img/ad.jpg"><button class="close"></button></a>--}}
    {{--</div>--}}
    {{--<div class="adflag right">--}}
        {{--<a href="http://91889188.87.cn" target="_blank"><img src="/img/ad.jpg"><button class="close"></button></a>--}}
    {{--</div>--}}
@endsection
@section('js')
    <script type="text/javascript" src="{{env('CDN_URL')}}/js/public/pc/video.js"></script>
    <script type="text/javascript">
        window.onload = function () { //需要添加的监控放在这里
            setADClose();
            LoadVideo();
        }
    </script>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{env('CDN_URL')}}/css/video.css">
@endsection