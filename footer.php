<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>

html, body {
    height: 100%;
}

body {
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 2px;
}

/* Footer CSS Here */
footer{
    background-color: #366682;
    /* letter-spacing: 2px; */
    margin: 0;
    padding: 0;
    width: 100%;
    text-align: center;
    display:block;
    min-height: auto;
}

.copyright {
    text-align: center;
    color: white;
}

.share-image, p.pfooter {
    font-size: 19px;
    color: white;
    margin: 0;
    padding: 5px 10px;
    text-align: left;
}

.footer-container {
    padding: 30px;
    text-align: left;
}

#social {
    width: 30px; 
    height: 30px;
}

.social {
    color: white;
    padding: 10px 10px;
}

.social:hover {
    background-color: #568686;
    text-decoration: underline;
}

.contact-site {
    color: white;
}

.contact-site:hover {
    color: #366682;
    background-color: white;
    text-decoration: underline; 
    padding: 0px;
}

h3 
{
    padding: 20px;
    font-size: 30px;
}

</style>

<!-- footer start here -->
<footer>

    <h3 class="footer" style="padding-top: 10px; color:black;">
    If you have any question or feedback, <br>please feel free to 
    <a href="contactus.php" target="_self" class="contact-site">CONTACT US !</a>
    </h3>

    <div class="footer-container">
        <!-- Email -->
        <div class="share-image">
            <p class="pfooter">
                <img src="../images/email.png" alt="Email Us!" style="width: 20px; height: 20px;" id="social">
                Email: &emsp;&emsp;&nbsp;
                <a href="mailto:secondlibros@gmail.com&amp; Subject=Feedback&amp; Body=?>" class="social"> secondlibros@gmail.com</a>
            </p>
        </div>

        <!-- Facebook -->
        <div class="share-image">
            <p class="pfooter">
                <img src="../images/facebook.png" alt="Second Libros" id="social">
                Facebook: &nbsp;
                <a href="http://www.facebook.com/secondlibros" target="_blank" class="social">Second Libros</a>
            </p>
        </div>

        <div class="share-image">
            <!-- Whatsapp -->
            <p class="pfooter">
                <img src="../images/whatsapp.png" alt="Whatsapp Us!" id="social">
                Whatsapp: &nbsp;
                <a href="tel:+60199654833" class="social">+60199654833</a>
            </p>
        </div>

        
        <div class="share-image">
        <!-- Instagram -->
            <p class="pfooter">
                <img src="../images/instagram.png" alt="Libros Online Bookstore" id="social">
                Instagram: &nbsp;
                <a href="http://instagram.com/2ndlibros" class="social">2nd Libros</a>
            </p>
        </div>

    </div>

    <small class="copyright">
        <i style="color: white; text-align: center;">Copyright &copy; 2020 Second Libros</i>
    </small>

</footer>

</html>