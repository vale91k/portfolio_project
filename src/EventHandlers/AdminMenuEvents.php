<?php

namespace App\EventHandlers;

class AdminMenuEvents
{
    /**
     * ex2-95
     * Упрощает меню админки для контент-менеджеров
     * @param array $aGlobalMenu
     * @param array $aModuleMenu
     */
    function SimplificationAdminMenu(array &$aGlobalMenu, array &$aModuleMenu): void
    {
        global $USER;

        // Получение всех груп текущего пользователя
        $userGroup = \CUser::GetUserGroupList($USER->GetID());

        // Получение id группы контент редакторов
        $contentGroupID = \CGroup::GetList(
            "c_sort",
            "asc",
            [
                "STRING_ID" => "content_editor"
            ]
        )->fetch()["ID"];

        while ($group = $userGroup->fetch()) {

            if ($group["GROUP_ID"] == 1) {
                $isAdmin = true;
            }

            if ($group["GROUP_ID"] == $contentGroupID) {
                $isManager = true;
            }

        }
        if ($isManager == true) {

            // Перебираем меню и сохраняем только меню news
            foreach ($aModuleMenu as $key => $item) {

                if ($item["items_id"] == "menu_iblock_/news") {

                    $aModuleMenu = [$item];

                    break;
                }
            }
            // Переписываем все меню, оставляя только массив меню Контент (где и хранятся наши news)
            $aGlobalMenu = ["global_menu_content" => $aGlobalMenu["global_menu_content"]];
        }
    }
}