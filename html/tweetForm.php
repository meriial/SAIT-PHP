<h1>Tweet Form</h1>

<?php echo formatErrors($errors) ?>

<form method="POST">
  <input type="text" name="tweet" value="<?php echo repopulate('tweet') ?>" />
  <input type="submit" name="submit" value="Submit" />
</form>

<table>
  <?php foreach( $tweets as $tweet ) { ?>
  <tr>
    <td><?php echo $tweet[0]; ?></td>
    <td><?php echo $tweet[1]; ?></td>
  </tr>
  <?php } ?>
</table>
