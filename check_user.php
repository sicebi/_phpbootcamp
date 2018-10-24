<?php
    function email_exists($people_list, $new_email)
    {
        foreach($people_list as $person)
        {
            if ($person["email"] === $new_email)
                return (1);
        }
        return (0);
    }

    function user_exists($people_list, $email, $password)
    {
        foreach($people_list as $person)
        {
            if ($person["email"] === $email && $person["password"] === $password)
                return (1);
        }
        return (0);
    }
?>