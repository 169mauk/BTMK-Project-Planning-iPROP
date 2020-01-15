<?php

?>
<div class="emerald-fixed-chat-face shadow" style="background-size: cover; background: url(<?= PORTAL ?>/assets/images/icons/commenting-o.png);" data-chat-toggle="toggle"></div>

<div class="lena-chat-overlay">
    <div class="header">
        <div class="row">
            <div class="col-2 text-left">
                <i class="fa fa-angle-left text-color-light typcn-lena" data-chat-toggle="toggle"></i>
            </div>
            <div class="col-8 text-center lena-separator-text">Chat</div>
            <div class="col-2 text-right">
                <i class="fa fa-ellipsis-h  text-color-light typcn-lena"></i>
            </div>
        </div>

    </div>
    <div class="body">
        <div class="lena-chat-element me">
            <div class="message">Hi there! How can I help you?</div>
        </div>
        <div class="lena-chat-element you">
            <div class="w-100 lena-display-inline-block">
                <img src="assets/img/avatar1.png" width="30" height="30" class="circle-shape outlined float-left shadow"
                     alt="">
                <div class="message">Hey there! How it's going?</div>
            </div>
        </div>
        <div class="lena-chat-element you">
            <img src="assets/img/avatar1.png" width="30" height="30" class="circle-shape outlined float-left shadow"
                 alt="">
            <div class="message">What's up?</div>
        </div>
        <div class="lena-chat-element me">
            <div class="message">Lena just released it's new version!</div>
        </div>
        <div class="lena-chat-element you">
            <img src="assets/img/avatar1.png" width="30" height="30" class="circle-shape outlined float-left shadow"
                 alt="">
            <div class="message">Wow cool!</div>
        </div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-7">
                <input type="text" placeholder="Message to send">
            </div>
            <div class="col-5 text-right">
                <button class="btn btn-primary btn-sm m-r-10">Send</button>
            </div>
        </div>
    </div>
</div>