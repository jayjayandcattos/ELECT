    <div class="about">
        <div class="footer-card">
            <div class="footer-card-inner">
                <div class="footer-card-front">
                    <img src="Pics/ELECT-Logo.png" alt="ELECT LOGO">
                    <h2>ELECT</h2>
                    <h3>Electronic Legislative Election<br>Counting Tracker</h3>
                    <br>
                    <p>
                        "Welcome to our ELECT! Where voting is
                        made easier for you! It's simple, secure, and
                        accessible. Your vote matters, and we're
                        here to make sure it's counted."
                    </p>
                    <p>© 2024</p>
                    <br>

                </div>
                <div class="footer-card-back">
                </div>
            </div>
        </div>

        <div class="team">
            <div class="circle">
                <div>
                    <h2>TEAM MEMBERS</h2>
                    <br>

                    <div class="team-members">

                        <div class="member">
                            <img src="Pics/team/SAMANTHA.png">
                            <p class="name">Samantha Jumuad</p>
                            <p class="role">Project Manager</p>
                        </div>
                        <div class="member">
                            <img src="Pics/team/JUSTIN.png">
                            <p class="name">Justin Rivera</p>
                            <p class="role">Lead Developer</p>
                        </div>
                        <div class="member">
                            <img src="Pics/team/HEILA.png">
                            <p class="name">Heila Longaquit</p>
                            <p class="role">Front-end Developer</p>
                        </div>
                        <div class="member">
                            <img src="Pics/team/AXEL.png">
                            <p class="name">Lord Axel Lomigo</p>
                            <p class="role">Documentation</p>
                        </div>
                        <div class="member">
                            <img src="Pics/team/CARLO.png">
                            <p class="name">Carlo Castillano</p>
                            <p class="role">LAN Engineer</p>
                        </div>
                        <div class="member">
                            <img src="Pics/team/HABOC.png">
                            <p class="name">Alexander Haboc</p>
                            <p class="role">Member</p>
                        </div>
                        <div class="member">
                            <img src="Pics/team/DAN.png">
                            <p class="name">Dan Sebastian</p>
                            <p class="role">Member</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .circle {
                display: flex;
                align-items: center;
                position: relative;
                flex-direction: column;
                text-decoration: none;
                color: #FFF;
                border: none;
                cursor: pointer;
                width: 100%;
                height: 100%;
                border-radius: 15px;
                z-index: 1;
            }

            .circle::after {
                content: '';
                position: absolute;
                top: -20%;
                right: 50%;
                z-index: -99999;
                transition: all .4s;
                transform: translate(50%, 50%);
                width: 1px;
                height: 1px;
                background: #ffffff15;
                backdrop-filter: blur(5px);
                -webkit-backdrop-filter: blur(5px);
                border-radius: 50px;
                border: #00a2ff 0px solid;
            }

            .circle:hover::after {
                border-radius: 15px;
                transform: translate(50%, 0%);
                width: 90%;
                height: 110%;
                top: -10%;
                border: #00a2ff 2px solid;
            }
        </style>