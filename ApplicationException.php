<?php
namespace WebStream\Exception;

/**
 * ApplicationException
 * @author Ryuichi TANAKA.
 * @since 2014/05/05
 * @version 0.4
 */
class ApplicationException extends \LogicException
{
    /**
     * @var string エラーメッセージ
     */
    private $errorMessage;

    /**
     * constructor
     * @param string $message エラーメッセージ
     * @param int $code ステータスコード
     * @param Exception $exception 例外オブジェクト
     */
    public function __construct($message, $code = 500, $exception = null)
    {
        parent::__construct($message, $code);

        if ($exception === null) {
            $exception = $this;
        }

        $this->errorMessage = get_class($exception) . " is thrown: " . $exception->getFile() . "(" . $exception->getLine() . ")";

        if (!empty($message)) {
            $stacktraceList = explode("#", $stacktrace);
            foreach ($stacktraceList as $stacktraceLine) {
                if ($stacktraceLine === "") {
                    continue;
                }
                $this->errorMessage .= PHP_EOL;
                $this->errorMessage .= "\t#" . trim($stacktraceLine);
            }
        }
    }

    /**
     * エラーメッセージを返却する
     * @return string エラーメッセージ
     */
    public function getExceptionAsString(): string
    {
        return $this->errorMessage;
    }
}
