<?php
$form = "properties";
?>
<h3><?= $lang['user_property_edit']; ?></h3>
<form action="post.php"
      method="POST">
  <div class="row">
    <div class="col">
      <div class="form-group pb-2">
        <label for="prop_id"
               class="pb-1 pt-1"><?= $lang['prop_id']; ?></label>
        <input type="text"
               disabled
               name="current_prop_ids"
               id="prop_id"
               class="form-control"
               value="<?= $prop_id; ?>"
               autocomplete="off"
               tabindex="2">
      </div>
    </div>
    <div class="col">
      <div class="form-group pb-2">
        <label for="find_prop_id"
               class="pb-2"><?= $lang['lookup_prop_id']; ?></label>
        <select id="prop_id"
                class="form-select"
                autocomplete="off"
                readonly="readonly"
                tabindex="-1">
          <?php $helper->find_property_id($lang); ?></select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group pb-1">
        <label for="new_prop_id"
               class="pb-1 pt-1"><?= $lang['new_prop_id']; ?></label>
        <input type="text"
               name="new_prop_id"
               id="new_prop_id"
               class="form-control">
      </div>
    </div>
    <div class="col align-self-end">
      <div class="form-group pb-1">
        <input type="hidden"
               name="id"
               value="<?= $id; ?>">
        <input type="hidden"
               name="dir"
               value="<?= $dir; ?>">
        <input type="hidden"
               name="page"
               value="<?= $page; ?>">
        <input type="hidden"
               name="current_prop_ids"
               value="<?= $prop_id; ?>">
        <input type="hidden"
               name="form_name"
               value="add_prop_id">
        <a href="list"
           class="btn btn-danger"
           tabindex="0"
           role="button"
           aria-pressed="false"><?= $lang['cancel']; ?>
        </a>
        <button type="submit"
                class="btn btn-success"
                value="Submit"
                tabindex="0"
                role="button"
                aria-pressed="false"><?= $lang['submit_prop_id']; ?>
        </button>
      </div>
    </div>
  </div>
</form>
<hr>
