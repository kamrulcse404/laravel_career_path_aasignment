<?php

namespace App;

class MoneyManager
{
    private $source;
    private $amount;

    public function addIncome(string $source, float $amount)
    {
        $this->source = $source;
        $this->amount = $amount;

        $filename = __DIR__ . "/income.txt";
        $file = fopen($filename, 'a+');
        $this->source = ucfirst($this->source);
        $singleIncomeLine = "Amount: $this->amount, Category: $this->source\n";

        if ($file) {
            fwrite($file, $singleIncomeLine);
            fclose($file);

            $categoryFileName = __DIR__ . "/categories.txt";
            $catFile = fopen($categoryFileName, 'a+');

            if ($catFile) {
                $categoryContents = file_get_contents($categoryFileName);
                $categoryNames = [];

                $pattern = '/Name: ([^,]+)/';
                if (preg_match_all($pattern, $categoryContents, $matches)) {
                    $categoryNames = $matches[1];
                }  
                $updatedCategoryNames = array_map('strtolower', $categoryNames);
                $this->source = strtolower($this->source);
                if (!in_array($this->source, $updatedCategoryNames)) {
                    $this->source = ucfirst($this->source);
                    $categoryLine = "Name: $this->source, Type: INCOME \n";

                    fwrite($catFile, $categoryLine);
                    fclose($catFile);            
                }
            }
            return "Income added successfully";
        } else {
            return "Something wrong to open file";
        }
    }

    public function addExpense(string $source, float $amount)
    {
        $this->source = $source;
        $this->amount = $amount;

        $saving = $this->viewSavings();
        if ($saving < $this->amount) {
            return "You don't have enough savings to expense!!";
        }

        $filename = __DIR__ . "/expense.txt";
        $file = fopen($filename, 'a+');
        $this->source = ucfirst($this->source);
        $singleExpenseLine = "Amount: $this->amount, Category: $this->source\n";

        if ($file) {
            fwrite($file, $singleExpenseLine);
            fclose($file);

            $categoryFileName = __DIR__ . "/categories.txt";
            $catFile = fopen($categoryFileName, 'a+');

            if ($catFile) {
                $categoryContents = file_get_contents($categoryFileName);
                $categoryNames = [];

                $pattern = '/Name: ([^,]+)/';
                if (preg_match_all($pattern, $categoryContents, $matches)) {
                    $categoryNames = $matches[1];
                }  
                $updatedCategoryNames = array_map('strtolower', $categoryNames);
                $this->source = strtolower($this->source);
                if (!in_array($this->source, $updatedCategoryNames)) {
                    $this->source = ucfirst($this->source);
                    $categoryLine = "Name: $this->source, Type: EXPENSE \n";

                    fwrite($catFile, $categoryLine);
                    fclose($catFile);            
                }
            }
            return "Expense added successfully";
        } else {
            return "Something wrong to open file";
        }
    }

    public function viewIncomes() : string
    {
        $filename = __DIR__ . '/income.txt'; 
        if (file_exists($filename)) {
            $file = fopen( $filename, 'r');
            if ($file) {
                $contents = fread($file, filesize($filename));
                if ($contents === false) {
                    return "Error reading the file $filename."; 
                } else {
                    fclose($file); 
                    return $contents; 
                } 
            }else{
                return "There is a problem in opening file";
            }
            
        } else {
            return "The file $filename does not exist.";
        }
    }

    public function viewExpenses() : string
    {
        $filename = __DIR__ . '/expense.txt'; 
        if (file_exists($filename)) {
            $file = fopen( $filename, 'r');
            if ($file) {
                $contents = fread($file, filesize($filename));
                if ($contents === false) {
                    return "Error reading the file $filename."; 
                } else {
                    fclose($file); 
                    return $contents; 
                } 
            }else{
                return "There is a problem in opening file";
            }
            
        } else {
            return "The file $filename does not exist.";
        }
    }

    public function viewSavings()
    {
        $totalIncome = 0;
        $totalExpense = 0;

        $filename = __DIR__ . '/income.txt'; 
        if (file_exists($filename)) 
        {
            $file = fopen( $filename, 'r');
            if ($file) 
            {
                $contents = file_get_contents($filename);
                $amounts = [];

                $pattern = '/Amount: ([^,]+)/';
                if (preg_match_all($pattern, $contents, $matches)) {
                    $amounts = $matches[1];
                }
                // print_r($amounts);
                
                for ($i=0; $i < count($amounts); $i++) { 
                    $totalIncome += $amounts[$i];
                }

            }else
            {
                return "There is a problem in opening file";
            }
        }

        $expenseFilename = __DIR__ . '/expense.txt'; 
        if (file_exists($expenseFilename)) 
        {
            $expenseFile = fopen( $expenseFilename, 'r');
            if ($expenseFile) 
            {
                $contents = file_get_contents($expenseFilename);
                $expenseAmounts = [];

                $pattern = '/Amount: ([^,]+)/';
                if (preg_match_all($pattern, $contents, $matches)) {
                    $expenseAmounts = $matches[1];
                }
                // print_r($amounts);
                for ($i=0; $i < count($expenseAmounts); $i++) { 
                    $totalExpense += $expenseAmounts[$i];
                }

            }else
            {
                return "There is a problem in opening file";
            }
        }

        return $totalIncome - $totalExpense;
    }

    public function viewCategories(): string
    {
        $filename = __DIR__ . '/categories.txt'; 
        if (file_exists($filename)) {
            $file = fopen( $filename, 'r');
            if ($file) {
                $contents = fread($file, filesize($filename));
                if ($contents === false) {
                    return "Error reading the file $filename."; 
                } else {
                    fclose($file); 
                    return $contents; 
                } 
            }else{
                return "There is a problem in opening file";
            }
            
        } else {
            return "The file $filename does not exist.";
        }
    }    
}
