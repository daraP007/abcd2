<?php
$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}

include('header.php');
$page_title = 'Project ABCD > About';   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> ABCD About Us (7.17.25)</title>
    <link href="css/about.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  
</head>


<body>
    <!--this is the tool bar-->
    <div class="container">
        <h2 id="aboutTitle">About CS320 2 SILC</h2>

        <img src="images/about_images/art_strip.jpg" class="aboutHead">

        <p id="directions">Project ABCD was created in the 2019-2020 school year by the current SILC CS320 (PHP) class students. Each of us have contibuted to the creation of the website by completing one functionality individually. We have then pushed our updates to Github repository. We used clone, pull, push, sync functions of GitHub to download the master baseline and to integrate our changes. The project is also hosted on Blue Host at our own webaddress.  Enjoy! <br> </]p
        <!--Lab 5 changes for demo-->
        


    </div>
    <div class="innerCont">
        <div class="profiles">
        <img src="images/about_images/siva.jpg">
        <h3 class="aboutName">Jashti Siva</h3>
        <h4 class="aboutTitle">Lead of Project ABCD</h4>
        <p class="aboutDescription">
            Dr. Jasthi is the primary instrutor for CS3 (PHP/MySQL) class. He has been working in the software industry in different capacities for the last 25 years. He is currently working as a Consultant in Siemens PLM Software Inc. For the last 20 years, he is serving as adjunct faculty in the Department of Computer Sciences and Cyber Security at Metropolitan State University (MN, USA). For the last 14 years, he has been an active volunteer at School of India for Languages and Culture (SILC) and offered his services as a Telugu Teacher, Webmaster, Principal, and President. He is currently serving on the SILC board of directors as Director of Technology. He is building a five-level Digital Literacy program for middle and high school students at SILC. He is currently leading the project ABCD (A Bite of Culture in Dresses) with the support and financial assistance from School of India for Languages and Culture (SILC) and Saintpaul Foundation.
</p>
</div>


<div class="profiles">
        <img src="images/about_images/babu.jpg">
        <h3 class="aboutName">Babu Dundrapelly</h3>
        <h4 class="aboutTitle">Artist</h4>
        <p class="aboutDescription">
        Babu was born in 1988 at Cheerlavancha village (Sirisilla Mandal, Karimnagar District, Telangana). He completed his primary education in Cheerlavancha and Choppadanda schools, his intermediate education at Manthani and Rukmapur social welfare residential schools. He discontinued his graduate studies to pursue his interest in arts and joined the Bachelor of Fine Arts program at JNTU College of Science and Arts in 2006. He earned Bachelors and Master of Fine Arts from the same institution.

        From 2010 to 2015, he completed several book projects as a resident artist at Arrow Publications. For the last five years, he has been working with Dr. Siva Jasthi on several collaborative projects. “Let’s Play” books, Project ABCD (A Bite of Culture Daily), Folk Performing Arts, Project ABCD (A Bite of Culture in Dresses) – are some projects in which he produced over 300 pieces of artwork. All the art work you see in this project ABCD (A Bite of Culture in Dresses) is created by him.
</p>
</div>


<div class="profiles">
        <img src="images/about_images/ahala.jpg">
        <h3 class="aboutName">Ahala Ayyalasomayajula</h3>
        <p class="aboutDescription">
            Ahala Ayyalasomayajula is a fifth grader at Future Kids School in Hyderabad, Telangana (India). Ahala loves to read and tell stories about Indian History. She learned to read and write Telugu at Manabadi, in Cary, NC. She started to develop a keen interest in Telugu Literature and began experimenting with writing Telugu poetry in fourth grade. She completed her first satakam, a collection of 108 stanzas covering multiple topics like History, family, Hindu epics etc. When Ahala is not reading or doing schoolwork, she practices Table-Tennis and Art. She enjoys riding her bicycle with her six-year-old sister. Her favorite down-time activity is 'pretend-play' – Ahala and her sister play English teachers to many imaginary students. Her most recent answer to 'What do you want to be when you grow up?', was ‘School Principal’.
</p>
</div>


</div>



</body>