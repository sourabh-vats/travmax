<?php $this->load->view('includes/front/leftsidebar'); ?>
<!-- <style type="text/css">

</style>
<div class="main">
    <div class="img_about">
        <img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/front/images/invite.jpg.png" alt=" " />
    </div>
</div>
<div class="container inner">
    <div class="row">
        <div class="col-md-12">
            <h3 class="invite text-center fw-bold">Your Unique Referral Code Is</h3>
            <p class="text-center">This Link automatically Connects your inivited friends to your circle</p>
            <div class="text-center input-copy">
                <input id="the_text" type="text" value="https://www.travmaxholidays.com?refer_id=<?php echo $cust_id; ?>" size="50">
                <button onclick="copyById('the_text')">copy to share <i class="fa fa-clone" aria-hidden="true"></i></button>
            </div>
            <div class="or">
                <img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/front/images/or.jpg" alt=" " />
            </div>
        </div>
        <div class="row" id="main-inner-btn-share">
            <div class="col-sm-2">
                <div class="whatsapp">
                    <a id="whatsapp_share_link" href="whatsapp://send?text=Join Travmax and earn free international travel!" data-action="share/whatsapp/share">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        <small>Invite via whatsapp</small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="twitter">
                <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <small>Invite via twitter</small>
                </a>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="instragram">
                <a href="#">
                    <i class="fa fa-instagram"></i>
                    <small>Invite via instragram</small>
                </a>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="mail">
                <a href="#">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <small>Invite via mail</small>
                </a>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="sms">
                <a href="#">
                    <i class="fa fa-comments"></i>
                    <small>Invite via sms</small>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
<section class="clip-path">
    <div class="container">
        <div class="clip_shadw">
            <div class="row">
                <div class="col-sm-9">
                    <h2 class="text-dark" style="font-weight: bold;">How it Works</h2>
                </div>
                <div class="col-sm-3">
                    <h2 class="text-dark" style="font-weight: bold;">Watch Video</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="clip">
                        <div class="clipss">
                            <h2>01</h2>
                            <h3>Invite Friend</h3>
                            <p>Just invite your friends to visit the website zoogol.in using your referral link</p>
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="clip cllipp">
                        <div class="clipss">
                            <h2>02</h2>
                            <h3>Friends Sign Up</h3>
                            <p>Your invited friends sign up using your referral link and get edit to your friend circle</p>
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="clip cllippzz">
                        <div class="clipss">
                            <h2>03</h2>
                            <h3>Earn Upto 11 Circles</h3>
                            <p>They share it further,you recieve moneyback in your account for every purchase up till Friend Circle 11</p>
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="jpeg">
                        <img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/front/images/smart.jpg" alt=" " />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<style>
#rewarding_text{
    font-size: 42px;
    color: #ff4244;
    font-weight: 700;
    line-height: 30px;
}
#referral_text{
    font-size: 50px;
    color: #03bcd1;
    font-weight: 800;
    line-height: 30px;
}
</style>
<div id="wrapper">
<img src="/images/invite_friend_cover.jpg" alt="">
<div class="row px-md-5 align-items-center">
    <div class="col-md-6 px-md-5 text-center">
        <p>
            Connect to the most <br>
            <span id="rewarding_text">Rewarding</span><br>
            <span id="referral_text">Referral<br>Program</span>
        </p>
        <p>
            Small sharing leads to big <br class="d-none d-md-block"> rewards and income.
        </p>
    </div>
    <div class="col-md-6 px-md-5">
        <img src="/images/invite_friend_side_graphic.png" alt="">
    </div>
</div>
</div>

<script type="text/javascript">
    // Author: Joseph Cowdell

    var whatsapp_share_link = document.getElementById("whatsapp_share_link");
    whatsapp_share_link.setAttribute('href', "whatsapp://send?text=" + window.location.href);

    copyText = function(textToCopy) {
        this.copied = false

        // Create textarea element
        const textarea = document.createElement('textarea')

        // Set the value of the text
        textarea.value = textToCopy

        // Make sure we cant change the text of the textarea
        textarea.setAttribute('readonly', '');

        // Hide the textarea off the screnn
        textarea.style.position = 'absolute';
        textarea.style.left = '-9999px';

        // Add the textarea to the page
        document.body.appendChild(textarea);

        // Copy the textarea
        textarea.select()

        try {
            var successful = document.execCommand('copy');
            this.copied = true
        } catch (err) {
            this.copied = false
        }

        textarea.remove()
    }

    copyById = function(id) {
        let text = document.getElementById(id)
        copyText(text.value)
    }

    copyPreviousSibling = function(curr) {
        let el = curr.previousElementSibling
        if (el.value !== undefined) {
            copyText(el.value)
        } else {
            copyText(el.textContent)
        }
    }

    // inpired by https://paulund.co.uk/javascript-copy-and-paste
</script>