<?php
?>
<style>
    .spinkx-popover-container {
        position: fixed;
        overflow: hidden;
        transition: opacity .2s ease-in-out;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: antialiased;
        flex-direction: column;
        word-wrap: break-word;
        background: rgba(0,0,0,0.7);
        z-index: 100000;
    }
    .spinkx-popover-body {
        position: relative;
        min-height: calc(100% - 100px);
        margin: 90px 50px 20px 50px;
        text-align: center;
        background-color: rgba(43, 75, 128, 0.8);
       /* background: url(./images/background-activation.jpg?5d0391b…) no-repeat 50%;*/
        background-size: cover;
        color: #fff;
        overflow: hidden;
        padding: 70px 20px 55px;
        box-sizing: border-box;
    }
    .spinkx-popover-close {
        position: absolute;
        color: red;
        right: 43px;
        z-index: 9;
        width: 50px;
        height: 50px;
        top: 90px;
        font-size: 30px;
        cursor: pointer;
        font-weight: 900;
    }
    .popover-logo-img img {
        height: 50px;
    }
    .spinkx-popover-content {
        text-align: left;
        margin: 20px 20px 20px 267px;
    }
    .spinkx-popover-content ul {
        list-style: inherit;
    }
    .spinkx-popover-content h4 {
        font-size: 18px;
        margin-left: -17px;
        margin-bottom: 20px;
    }
</style>
<div class="spinkx-popover-container">
    <div class="spinkx-popover-close">X</div>
    <div class="spinkx-popover-body">
        <h1><span class="popover-logo-img"><img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/spinkx-logo.png" /></span>Content Marketing</h1>

        <div class="spinkx-popover-content">
            <h4>**our features**</h4>
            <ul>
                <li>Bp</li>
                <li>Camapigns</li>
            </ul>
        </div>

    </div>
</div>
