<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 10/10/2559
 * Time: 23:06 น.
 */
use yii\helpers\Html;
?>
<div class="span9">
    <ul class="breadcrumb">
        <li><?= Html::a('Home', ['/']) ?> <span class="divider">/</span></li>
        <li class="active">About and Contact</li>
    </ul>
    <h3>Visit us</h3>
    <hr class="soften"/>
    <div class="row-fluid">
        <div class="span3"><?= $contact->content_text ?></div>
        <div class="span3">
            <h4>Opening Hours</h4>
            <h5> Monday - Friday</h5>
            <p>09:00am - 09:00pm<br/><br/></p>
            <h5>Saturday</h5>
            <p>09:00am - 07:00pm<br/><br/></p>
            <h5>Sunday</h5>
            <p>12:30pm - 06:00pm<br/><br/></p>
        </div>
        <div class="span5 offset1">
            <h4>Email Us</h4>
            <form class="form-horizontal" action="/mail" method="post">
                <?= Html::hiddenInput('_csrf-frontend', Yii::$app->request->getCsrfToken()) ?>
                <fieldset>
                    <div class="control-group">

                        <input name="name" type="text" placeholder="name" class="input-xlarge"/>

                    </div>
                    <div class="control-group">

                        <input name="email" type="text" placeholder="email" class="input-xlarge"/>

                    </div>
                    <div class="control-group">

                        <input name="subject" type="text" placeholder="subject" class="input-xlarge"/>

                    </div>
                    <div class="control-group">
                        <textarea name="message" rows="3" id="textarea" class="input-xlarge"></textarea>

                    </div>

                    <button class="btn btn-large" type="submit">Send Messages</button>

                </fieldset>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="span9">
            <div class="p20"><?= $about->content_text ?></div>
        </div>
    </div>
    <?php
    /*<div class="row">
        <div class="span9">
            <iframe style="width:100%; height:300; border: 0px" scrolling="no" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14&amp;output=embed"></iframe><br />
            <small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14" style="color:#0000FF;text-align:left">View Larger Map</a></small>
        </div>
    </div>*/
    ?>
</div>

