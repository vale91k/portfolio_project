<?php
/**
 * @return string
 */
function CheckUserCount()
{
    $date = new DateTime();
    //Приводим дату к необходимому нам виду
    $date = \Bitrix\Main\Type\DateTime::createFromTimestamp($date->getTimestamp());
    // Получаем из системы записанное ранее свойства
    $lastDate = COption::GetOptionString("main", "last_date_agent_checkUserCount");
    // Если свойство не пустое формируется фильтр
    if ($lastDate) {
        $arFilter = ["DATE_REGISTER_1" => $lastDate];
    } else {
        $arFilter = [];
    }
    $arUsers = [];
    // Получение списка пользователей по фильтру
    $rsUser = CUser::GetList(
      "DATE_REGISTER",
      "ASC",
      $arFilter
    );
    while ($user = $rsUser->Fetch()){
        $arUsers[] = $user;
    }
    if (!$lastDate){
        $lastDate = $arUsers[0]["DATE_REGISTER"];
    }
    // Получаем разницу в секундах между текущей датой и датой последнего запуска функции
    $difference = intval(abs(strtotime($lastDate) - strtotime($date->toString())));
    // Преобразование секунды в дни
    $days = round($difference / (3600 * 24));
    // Получаем количество пользователей
    $countUsers = count($arUsers);
    // Получаем всех админов
    $rsAdmin = CUser::GetList(
        "ID",
        "ASC",
        ["GROUPS_ID" => 1]
    );
    while ($admin = $rsAdmin->Fetch()){
        // Отправляем в цикле письма админам
        CEvent::Send(
            "COUNT_REGISTERED_USERS",
            "s1",
            [
                "EMAIL_TO" => $admin["EMAIL"],
                "COUNT_USERS" => $countUsers,
                "COUNT_DAYS" => $days,
            ],
            "Y",
            "32"
        );
    }
    // Записываем в систему дату отработки скрипта
    COption::SetOptionString("main", "last_date_agent_checkUserCount", $date->toString());

    return "CheckUserCount();";
}