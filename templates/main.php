
<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach ($project as $pr_item): ?>
                <li class="main-navigation__list-item">
                    <a class="main-navigation__list-item-link" href="#"><?=htmlspecialchars($pr_item); ?></a>
                    <span class="main-navigation__list-item-count"><?php echo array_count_values(array_column($taskInfo, 'task_type'))[$pr_item]; ?></span>
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
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if($show_complete_tasks):?>checked<?php endif; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php foreach ($taskInfo as $key => $val): ?>
            <?php if (($val['task_full'])&&(!$show_complete_tasks)) continue;?>
            <tr class="tasks__item task <?php if($val['task_full']):?>task--completed<?php endif; ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?php if($val['task_full']):?>checked<?php endif; ?>>
                        <span class="checkbox__text"><?=htmlspecialchars($val['task_name']); ?></span>
                    </label>
                </td>
                <td class="task__date">
                    <?=$val['task_date']; ?>
                </td>
                <td class="task__date">
                    <?=$val['task_type']; ?>
                </td>
            </tr>
        <? endforeach; ?>
    </table>
</main>
