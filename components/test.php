<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Professional Layout</title>
<style>
  /* CSS styles */
  .container {
    display: flex;
    justify-content: center; /* Centering the items horizontally */
    flex-wrap: wrap; /* Allowing flex items to wrap to the next line */
    gap: 20px; /* Adding space between the flex items */
    width: 80%; /* Adjusting the width of the container */
    margin: 0 auto; /* Centering the container horizontally */
    transition: all 0.5s ease-in-out; /* Adding transition to the container */
  }
  .box {
    width: calc(30% - 20px); /* Adjusting the width to account for margin */
    padding: 20px;
    border: 2px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: all 0.3s ease-in-out; /* Adding transition to the boxes */
  }
  .box:hover {
    transform: scale(1.05); /* Scaling up the box on hover */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Adding a stronger shadow on hover */
  }
  .box h2 {
    text-align: center;
    margin-bottom: 10px;
    transition: color 0.3s ease-in-out; /* Adding transition to the heading color */
  }
  .box p {
    transition: color 0.3s ease-in-out; /* Adding transition to the paragraph color */
  }
</style>
</head>
<body class="body">

<div class="container">
  <div class="box">
    <h2>Box 1</h2>
    <p>This is the content of Box 1.</p>
  </div>
  <div class="box">
    <h2>Box 2</h2>
    <p>This is the content of Box 2.</p>
  </div>
  <div class="box">
    <h2>Box 3</h2>
    <p>This is the content of Box 3.</p>
  </div>
  <div class="box">
    <h2>Box 4</h2>
    <p>This is the content of Box 4.</p>
  </div>
  <div class="box">
    <h2>Box 5</h2>
    <p>This is the content of Box 5.</p>
  </div>
</div>

<script>
  // JavaScript (optional)
  // You can add JavaScript here if you want to add interactivity to your layout.
</script>

</body>
</html>
