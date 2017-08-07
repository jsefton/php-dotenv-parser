<?php
namespace Jsefton\DotEnv;

class Parser {

    /**
     * .env file to array conversion
     *
     * @param $envPath
     * @return array
     */
    public static function envToArray($envPath)
    {
        $variables = [];
        $content = file_get_contents($envPath);
        $lines = explode("\n", $content);
        if($lines) {
            foreach($lines as $line) {
                // If not an empty line then parse line
                if($line !== "") {
                    // Find position of first equals symbol
                    $equalsLocation = strpos($line, '=');

                    // Pull everything to the left of the first equals
                    $key = substr($line, 0, $equalsLocation);

                    // Pull everything to the right from the equals to end of the line
                    $value = substr($line, ($equalsLocation + 1), strlen($line));

                    $variables[$key] = $value;

                } else {
                    $variables[] = "";
                }
            }
        }
        return $variables;
    }

    /**
     * Array to .env file storage
     *
     * @param $array
     * @param $envPath
     */
    public static function arrayToEnv($array, $envPath)
    {
        $env = "";
        $position = 0;
        foreach($array as $key => $value) {
            $position++;
            // If value isn't blank, or key isn't numeric meaning not a blank line, then add entry
            if($value !== "" || !is_numeric($key)) {
                // If passed in option is a boolean (true or false) this will normally
                // save as 1 or 0. But we want to keep the value as words.
                if(is_bool($value)) {
                    if($value === true) {
                        $value = "true";
                    } else {
                        $value = "false";
                    }
                }

                // Always convert $key to uppercase
                $env .= strtoupper($key) . "=" . $value;

                // If isn't last item in array add new line to end
                if($position != count($array)) {
                   $env .= "\n";
                }
            } else {
                $env .= "\n";
            }
        }

        file_put_contents($envPath, $env);
    }
}

