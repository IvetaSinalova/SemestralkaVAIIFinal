<?php /** @var Array $data */ ?>

<div class="container-fluid">
    <div class="row">
        <div class="welcome_img">
            <div class="welcome_text centered">Nechajte vašich domácich miláčikov v najlepších rukách.</div>
        </div>
    </div>

    <div class="part">
        <div class="row">

            <div class="col-12">
                <?php if($data['errorRegistration'] != null) {?>
                    <div class="alert msgSearch alert-dismissible">
                        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong><?= $data['errorRegistration'] ?></strong>
                    </div>
                    <br>
                <?php } ?>
                Potrebujete postrážiť alebo vyvenčiť domáce zviera v čase vašej neprítomnosti?
                <strong>Tak ste tu správne!</strong>
                Vyberte si spomedzi našich overených užívateľov a užívateliek!<br>
                <a class="btn"  href="?c=home&a=users" role="button">Vybrať si</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                Alebo naopak chcete tieto služby ponúkať?
                <strong>Tak neváhajte a pridajte sa k nám!</strong><br>
                <a class="btn" href="?c=auth&a=registerForm" role="button">Registrovať sa</a>

            </div>

        </div>

    </div>
    <div class="row curve_top dark_bg"></div>
    <div class="row part dark_bg justify-content-center">
        <h1>Pravidlá</h1>
        <div class="col-12 col-md-6">
            <ul>
                <li>But I must explain to you how all this mistaken idea of denouncing pleasure and praising
                    pain
                </li>
                <li>dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not
                    know
                </li>
                <li>
                    was born and I will give you a complete account of the system, and expound the actual
                    teachings
                </li>
                <li>of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                </li>
                <li>
                    how to pursue pleasure rationally encounter consequences that are extremely painful.
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-3">
            <img src="https://www.trainpetdog.com/wp-content/themes/mytheme/images/about-page-images/Old-English-Sheepdog-origin.png"
                 alt="peso">
        </div>
    </div>
    <div class="row curve_bottom dark_bg"></div>
    <div id="info">
        <div class="row justify-content-center light_bg part">
            <h1>O nás</h1>
            <div class="col-12">
                Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et
                Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the
                theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor
                sit amet..", comes from a line in section 1.10.32.
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>