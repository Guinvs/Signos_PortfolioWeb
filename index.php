<?php include("header.php"); ?>

<div class="container mt-5">
  <h1 class="text-center">Descubra seu Signo</h1>

  <form method="POST" action="show_zodiac_sign.php" class="mt-4">
    <div class="mb-3">
      <label>Data de nascimento:</label>
      <input type="date" name="data_nascimento" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">Descobrir Signo</button>
  </form>
</div>

</body>
</html>