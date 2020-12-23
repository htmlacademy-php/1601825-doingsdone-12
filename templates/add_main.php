<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach ($project as $pr_item): ?>
                <li class="main-navigation__list-item">
                    <a class="main-navigation__list-item-link <?php if ($ProjectID==$pr_item['id']): ?> main-navigation__list-item--active<?php endif;?>" href="/?taskF=<?=($pr_item['id']); ?>"><?=htmlspecialchars($pr_item['project_name']); ?></a>
                    <span class="main-navigation__list-item-count"><?php
                        $count=array_count_values(array_column($taskInfo, 'task_project'))[$pr_item['id']];
                        echo (!$count)? 0 : $count; ?></span>
                </li>
            <? endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="../pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

    <form class="form" action="add.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <input class="form__input <?php if ($error_task_form['name_err']): ?>form__input--error<?php endif;?>" type="text" name="name" id="name" value="<?=getPostVal('name'); ?>" placeholder="Введите название">
            <p class="form__message"><?php if(isset($error_task_form['name'])): ?><?=$error_task_form['name']?><?php endif;?></p>
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
            <select class="form__input form__input--select <?php if ($error_task_form['progect']): ?>form__input--error<?php endif;?>" name="project" id="project">
                <?php foreach ($project as $pr_item): ?>
                <option value="<?=$pr_item['id']; ?>"><?=$pr_item['project_name']; ?></option>
                <? endforeach; ?>
            </select>
            <p class="form__message"><?php if ($error_task_form['progect']): ?><?=$error_task_form['progect']?><?php endif;?></p>
        </div>

        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>
            <input class="form__input form__input--date <?php if(isset($error_task_form['date'])): ?>form__input--error<?php endif;?>" type="text" name="date" id="date" value="<?=getPostVal('date'); ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <p class="form__message"><?php if(isset($error_task_form['date'])): ?><?=$error_task_form['date']?><?php endif;?></p>
        </div>

        <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <input class="visually-hidden" type="file" name="file" id="file" value="">

                <label class="button button--transparent" for="file">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</main>
