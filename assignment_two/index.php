#!/usr/bin/php

<?php

require_once 'vendor/autoload.php'; 
use App\MoneyManager;

$moneyManager = new MoneyManager();

while(true)
{
    echo "1. Add income \n";
    echo "2. Add expense \n";
    echo "3. View incomes \n";
    echo "4. View expenses \n";
    echo "5. View savings \n";
    echo "6. View categories \n";
    echo "7. Exit \n";
    
    $option = intval(readline('Enter your option : '));

    
    if ($option === 1)
    {
        $amount = floatval(readline('Enter amount of income : '));
        $incomeSource = readline('Write income category : ');
        $result = $moneyManager->addIncome($incomeSource, $amount);
        echo "\n\n" . $result . "\n\n";
    }
    elseif ($option === 2)
    {
        $amount = floatval(readline('Enter amount of expense : '));
        $expenseSource = readline('Write expense category : ');
        $result = $moneyManager->addExpense($expenseSource, $amount);
        echo "\n\n" . $result . "\n\n";
    }
    elseif ($option === 3)
    {
        $result = $moneyManager->viewIncomes();
        echo "\nIncomes\n";
        echo "-------------------------------\n";
        echo $result . "\n\n";
    }
    elseif ($option === 4)
    {
        $result = $moneyManager->viewExpenses();
        echo "\nExpenses\n";
        echo "-------------------------------\n";
        echo $result . "\n\n";
    }
    elseif ($option === 5)
    {
        $result = $moneyManager->viewSavings();
        echo "\nSavings\n";
        echo "----------------------------\n";
        echo "Total Savings : " .$result . " Taka\n\n";
    }
    elseif ($option === 6)
    {
        $result = $moneyManager->viewCategories();
        echo "\n\nCategories\n";
        echo "----------------------\n";
        echo $result . "\n\n";
    }
    elseif ($option === 7) 
    {
        break;
    }
    else 
    {
        echo "\n\nYou have entered wrong option\n\n";
    }
}