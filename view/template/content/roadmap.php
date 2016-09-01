<?php Response::setMetaDescription(__('roadmap.description')) ?>
<?php Response::addJsAsset('/js/roadmap.js') ?>
<?php NavActions::setNavUri('/learn') ?>
<?php echo View::render('nav/_header', ['isDark' => false]) ?>
<?php js_start() ?>
  lbry.roadmap('#project-roadmap');
<?php js_end() ?>
<main>
  <div class="hero hero-quote hero-img hero-img-short spacer1" title="Here Be Dragons" style="background-image: url(/img/here-be-dragons.jpg)">
    <div class="hero-content-wrapper">
      <div class="hero-content text-center">
        <h1 class="cover-title">{{roadmap.title}}</h1>
        <h2 class="cover-subtitle">Past successes and future plans for the journey into the land of dragons.</h2>
      </div>
    </div>
  </div>
  <div style="max-width: 800px; margin: 0 auto">
    <div class="roadmap-container" id="project-roadmap">
      <div class="text-center"><a href="javascript:;" class="link-primary show-all-roadmap-groups">Show Earlier Releases</a></div>
      <?php foreach($items as $group => $groupItems): ?>
        <?php $lastItem = end($groupItems) ?>
        <?php $isOpen = !isset($lastItem['project']) || !isset($lastItem['version']) || $lastItem['version'] === $projectMaxVersions[$lastItem['project']] ?>
        <h2 class="roadmap-group-title" <?php echo !$isOpen ? 'style="display: none"' : '' ?>">
          <span class="roadmap-group-title-label">
            <?php echo $group ?>
          </span>
        </h2>
        <div class="roadmap-group <?php echo !$isOpen ? 'roadmap-group-closed' : '' ?>">
          <?php $lastItem = end($groupItems) ?>
          <?php $maxItems = isset($lastItem['version']) ? 3 : count($groupItems) ?>
          <?php $index = 0 ?>
          <?php if (count($groupItems) > $maxItems): ?>
            <div class="text-center spacer1"><a href="javascript:;" class="link-primary show-all-roadmap-group-items">Show All Items for <?php echo $group ?></a></div>
          <?php endif ?>
          <?php foreach($groupItems as $item): ?>
            <?php ++$index ?>
            <div class="roadmap-item" <?php echo $index <= count($groupItems) - $maxItems ? 'style="display: none"' : '' ?>>
              <?php if (isset($item['badge']) || isset($item['assignee'])): ?>
                <div>
                  <?php if (isset($item['assignee'])): ?>
                    <span class="roadmap-item-assignee"><?php echo $item['assignee'] ?></span>
                  <?php endif ?>
                  <?php if (isset($item['badge'])): ?>
                    <span class="badge"><?php echo $item['badge'] ?></span><br/>
                  <?php endif ?>

                </div>
              <?php endif ?>
              <h3 class="roadmap-item-title">
                <?php echo $item['name'] ?>
              </h3>
              <div class="roadmap-item-date">
                <?php echo $item['date'] ?>
              </div>
              <div class="roadmap-item-content">
                <?php echo $item['body'] ?: '<em class="no-results">No description</em>' ?>
                <?php if (isset($item['github_url'])): ?>

                <?php endif ?>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</main>
<?php echo View::render('nav/_footer') ?>
<?php /*

  <div class="content content-light spacer2">
    <section class="spacer2">
      <h2>Recent Changes</h2>
      <table class="content full-table" id="changeset-table">
        <?php $setCount = 0 ?>
        <thead>
          <th>Release</th>
          <th>Date</th>
          <th>Notes</th>
        </thead>
        <?php foreach($changesets as $version => $changeset): ?>
          <tr <?php echo ++$setCount > 5 ? 'style="display: none"' : '' ?>>
            <th style="width: 15%">
              <?php echo $version ?>
              <?php if ($changeset['prerelease']): ?>
                <span class="badge badge-info">prerelease</span>
              <?php endif ?>
            </th>
            <td style="width: 15%" class="center"><?php echo $changeset['published_at'] ?></td>
            <td><?php echo $changeset['body'] ?></td>
          </tr>
          <?php if ($version == 'v0.2.2'): ?>
            <tr style="display: none">
              <th>v0.1-v0.2.2</th>
              <td></td>
              <td>These releases were not tagged and noted properly. We were too busy creating awesome!</td>
            </tr>
          <?php endif ?>
        <?php endforeach ?>
      </table>
      <a href="javascript:;" class="link-primary" id="show-all-changesets">show all changes</a>
      <?php js_start() ?>
        $('#show-all-changesets').click(function() {
          $(this).hide();
          $('#changeset-table').find('tr').show();
        });
      <?php js_end() ?>
    </section>
    <section class="spacer2">
      <h2>Upcoming Changes</h2>
      <table class="content full-table">
        <thead>
          <th>Item</th>
          <th>Date</th>
          <th>Component</th>
          <th>Owner</th>
        </thead>
        <?php foreach($items as $task): ?>
          <tr>
            <td><?php echo $task['name'] ?></td>
            <td style="width: 15%"><?php echo $task['due_on'] ?></td>
            <td style="width: 20%">
              <?php if ($task['url']): ?>
                <a href="<?php echo $task['url'] ?>" class="link-primary"><?php echo $task['project'] ?></a>
              <?php else: ?>
                <?php echo $task['project'] ?>
              <?php endif ?>
            </td>
            <td style="width: 20%">
              <?php echo $task['assignee'] ?: '<em>unassigned</em>' ?>
            </td>
          </tr>
        <?php endforeach ?>
      </table>
    </section>
  </div>
</main>

 */ ?>