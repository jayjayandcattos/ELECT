  <!DOCTYPE html>
  <html>
  <head>
    <title>Flip modal Animation</title>
    <style>
      .modal-container {
        perspective: 1000px;
        width: 1000px;
        margin: 0 40%;
        height: 200px;
        margin: 50px auto;
        position: relative;
      }

      .modal {
        position: absolute;
        width: 100%;
        height: 100%;
        transition: transform 0.8s, opacity 0.8s;
        transform-style: preserve-3d;
        transform: rotateY(90deg);
        opacity: 0;
      }

      .modal.is-flipped {
        transform: rotateY(0deg);
        opacity: 1;
      }

      .modal.is-closing {
        transform: rotateY(90deg);
        opacity: 0;
      }

      .modal-face {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        text-align: center;
        padding: 20px;
        box-sizing: border-box;
        border-radius: 25px;
        background-color: rgba(0, 0, 0, 0.7); /* Black with transparency */
        backdrop-filter: blur(10px); /* Background blur effect */
        box-shadow: 0px 4px 15px rgba(0, 0, 255, 0.5); /* Blue shadow */
        color: white; /* Text color */
        border: solid 2px blue;
      }

      .modal-face.back {
        transform: rotateY(180deg);
      }

      .button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      .close-button {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 50%; 
        width: 30px;
        height: 30px;
        padding: 0;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .modal-title {
        position: absolute;
        top: 30px;
        left: 20px;
        font-size: 18px;
        font-weight: bold;
      }
    </style>
  </head>
  <body>

    <div class="modal-container">
      <button class="button">Show modal</button>
      <div class="modal">
        <div class="modal-face front">
          <div class="modal-title">My modal</div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget nulla vel augue feugiat sagittis.</p>
          <button class="close-button">✖</button>
        </div>
        <div class="modal-face back">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at arcu vehicula, convallis erat vel, egestas erat.</p>
        </div>
      </div>
    </div>

    <script>
      const button = document.querySelector('.button');
      const modal = document.querySelector('.modal');
      const closeButton = document.querySelector('.close-button');

      button.addEventListener('click', () => {
        modal.classList.add('is-flipped');
      });

      closeButton.addEventListener('click', () => {
        modal.classList.add('is-closing');
        setTimeout(() => {
          modal.classList.remove('is-flipped');
          modal.classList.remove('is-closing');
        }, 800); // Adjust timeout to match animation duration
      });
    </script>

  </body>
  </html>
