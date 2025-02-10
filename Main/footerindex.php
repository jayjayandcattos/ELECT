<div class="dev-format-container">
  <div class="web">
    <h1>Follow Us!</h1>
    <div class="dev-content">
      <div class="dev-icon">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook Logo" style="margin-left:30px">
      </div>
      <a href="https://www.facebook.com/QCUKALABAW" target="_blank" class="social-desc">
        <h2>@ELECTQCU</h2>
      </a>
    </div>
  </div>

  <div class="dev-box">
    <div class="devs enlarge">
      <a href="https://github.com/jayjayandcattos" target="_blank" class="dev-link">
        <div class="dev-content">
          <div class="dev-icon">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Octicons-mark-github.svg" alt="GitHub Logo" class="social-logo">
          </div>
          <div class="dev-text">
            <div>
              <h3>Justin Rivera</h3>
              <p>Lead Developer</p>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="devs enlarge">
      <a href="https://github.com/sammehbleh" target="_blank" class="dev-link">
        <div class="dev-content">
          <div class="dev-icon">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Octicons-mark-github.svg" alt="GitHub Logo" class="social-logo">
          </div>
          <div class="dev-text">
            <div>
              <h3>Samantha Jumuad</h3>
              <p>Project Manager</p>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="devs enlarge">
      <a href="https://github.com/hei-design" target="_blank" class="dev-link">
        <div class="dev-content">
          <div class="dev-icon">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Octicons-mark-github.svg" alt="GitHub Logo" class="social-logo">
          </div>
          <div class="dev-text">
            <div>
              <h3>Heila Longaquit</h3>
              <p>Front-End Developer</p>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

</div>

<style>
  /* CSS */
  .dev-format-container {
    width: auto;
    margin: 0 auto;
    display: flex;
    flex-direction: row;
    justify-content: center;
  }

  .dev-box {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    padding: 50px 0;
    transform: scale(1);
    opacity: 1;
    animation: enlarge 1s ease alternate-reverse;
    will-change: transform;
  }

  @keyframes enlarge {
    0% {
      transform: scale(1);
    }

    100% {
      transform: scale(1.08);
    }
  }



  .devs {
    flex-basis: calc(33.33333% - 30px);
    margin: 0 15px 30px;
    display: flex;
    align-items: center;
    position: relative;
    background: transparent;
    border: none;
  }

  .dev-content {
    display: flex;
    flex-direction: row;
    z-index: 2;
    align-items: center;
  }

  .dev-icon img {
    width: 50px;
    height: 50px;
    margin-right: 20px;
    border-radius: 50%;
    background-color: #FFF;
    padding: 5px;
  }

  .dev-text {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    color: aliceblue;
  }

  .dev-text h3,
  .dev-text p {
    text-align: left;
  }

  .dev-text h3 {
    font-size: 18px;
  }

  .dev-text p {
    font-size: 14px;
  }


  .devs {
    flex-direction: row;
    align-items: center;
  }

  .web {
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .social-desc {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    position: relative;
    display: inline-block;
    text-decoration: none;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
  }

  .social-desc::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: #3498db;
    transform: scaleX(0);
    transform-origin: bottom right;
    transition: transform 0.3s ease;
  }

  .social-desc:hover::after {
    transform: scaleX(1);
    transform-origin: bottom left;
  }

  .social-desc:hover {
    color: #3498db;
  }



  .dev-link {
    display: flex;
    align-items: center;
    padding: 20px 10px 20px 30px;
    position: relative;
    text-decoration: none;
    color: #FFF;
    border: none;
    cursor: pointer;
    width: 350px;
    height: 120px;
    border-radius: 15px;
    box-shadow: 8px 8px 24px 3px rgba(24, 91, 133, 0.6);
    background: linear-gradient(315deg, #001a5f 3%, #04377c 38%, #1e2f97 68%, #2f1072 98%);
    animation: gradient 10s ease infinite;
    background-size: 400% 400%;
    background-attachment: fixed;
    z-index: 1;
  }

  .dev-link::before,
  .dev-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: -99999;
    transition: all .4s;
  }

  .dev-link::before {
    transform: translate(0%, 0%);
    width: 100%;
    height: 100%;
    border-radius: 15px;
  }

  .dev-link::after {
    transform: translate(10px, 10px);
    width: 35px;
    height: 35px;
    background: #ffffff15;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border-radius: 50px;
    border: #00a2ff 2px solid;
  }

  .dev-link:hover::before {
    transform: translate(5%, 20%);
    width: 110%;
    height: 110%;
  }

  .dev-link:hover::after {
    border-radius: 15px;
    transform: translate(-18px, -20px);
    width: 90%;
    height: 90%;
  }

  .dev-link:active::after {
    transition: 0s;
    transform: translate(-18px, -13px);
  }



  @keyframes gradient {
    0% {
      background-position: 0% 0%;
    }

    50% {
      background-position: 100% 100%;
    }

    100% {
      background-position: 0% 0%;
    }
  }
</style>