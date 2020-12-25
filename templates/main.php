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
       href="pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item <?php if($TaskFiltr == ''):?>tasks-switch__item--active<?php endif;?>">Все задачи</a>
            <a href="/?type=2" class="tasks-switch__item <?php if($TaskFiltr == 2):?>tasks-switch__item--active<?php endif;?>">Повестка дня</a>
            <a href="/?type=3" class="tasks-switch__item <?php if($TaskFiltr == 3):?>tasks-switch__item--active<?php endif;?>">Завтра</a>
            <a href="/?type=4" class="tasks-switch__item <?php if($TaskFiltr == 4):?>tasks-switch__item--active<?php endif;?>">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if($show_complete_tasks):?>checked<?php endif; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>

    </div>

    <table class="tasks">
        <?php foreach ($taskInfo as $key => $val): ?>
            <?php if((($val['task_project'])!=$ProjectID) and ($ProjectID != '')) continue; ?>
            <?php if (($val['task_status'])&&(!$show_complete_tasks)) continue;?>
            <tr class="tasks__item task <?php if((diferDate($date_1, $val['task_date_end']))&&(!$val['task_status'])):?>task--important<?php endif; ?><?php if($val['task_status']):?>task--completed<?php endif; ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?php if($val['task_status']):?>checked<?php endif; ?>>
                        <span class="checkbox__text"><?=htmlspecialchars($val['task_name']); ?></span>
                    </label>
                </td>
                <td class="task__file <?php if ($val['task_file']): ?>download-link <?php endif;?>"><a href="<?=$val['task_file']; ?>"><?=$val['task_file']; ?></a>
                </td>
                <td class="task__date">
                    <?=$val['task_date_end']; ?>
                </td>
                <td class="task__date">
                    <?php foreach ($project as $pr_item): ?>
                    <?php if ($pr_item['id']!=$val['task_project']) continue;?>
                    <?=$pr_item['project_name']; ?>
                    <? endforeach; ?>
                </td>
            </tr>
        <? endforeach; ?>
    </table>
</main>
