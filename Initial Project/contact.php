<?php
include_once 'fixed/header.php';

?>
<div>
    <center>
        <h2 style="color: #0d6efd;">Contact Us</h2>
            <article>
                For general inquiries, send us a message or send us an e-mail at xyz@gmail.com.
            </article>
        <b>
            You can write to us using the contact form and we will get back to your shortly.
        </b>
    </center>
</div>
<div>

    <form action="main.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="username" required="required">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" name="email" required="required">
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input type="number" class="form-control" name="contact" required="required">
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea name="sms" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <center>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-success btn-block btn-lg" name="contactus">Send Message</button>
            </div>
        </center>
    </form>
</div>
<div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2">
        <div class="col">
            <center>
                <h4>HotLines.</h4>
            </center>
            <ul style="list-style: none;">
                <li>Nairobi: +2547 1234 2456</li>
                <li>Baribgo: +254-0000-9999</li>
                <li>Nakuru: +2547-6788-8890</li>
                <li>Kisii: +254-4500-9900</li>
                <li>Mombasa: +2547-1235-1025</li>
                <li>Kisumu: +254-0044-0000</li>
                <li>Garisa: +254-4544-9999</li>
            </ul>
        </div>
        <div class="col">
            <center>
                <h4>Postal Address.</h4>
            </center>
            <ul style="list-style: none;">
                <li>Hopkins Cresent Hospital.</li>
                <li>P.O BOX 35425, Nakuru.</li>
                <li>Fax +2547-5388-9000.</li>
                <li>hopkinscresent@gmail.com</li>
            </ul>
        </div>
    </div>
</div>
<div>
</div>

<?php
include_once 'fixed/footer.php';

?>