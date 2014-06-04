<?php
/**
 * {license_notice}
 *
 * @copyright  {copyright}
 * @license    {license_link}
 */
namespace Mtf\System\Event;

/**
 * Class for keeping State of the system
 */
class State
{
    /**
     * Test main flow stage
     * @const
     */
    const TEST_MAIN_FLOW_STAGE = 'Test Main Flow';

    /**
     * Name for current Test suite
     *
     * @var string
     */
    private static $testSuiteName;

    /**
     * Name for current Test class
     *
     * @var string
     */
    private static $testClassName;

    /**
     * Name for current Test method
     *
     * @var string
     */
    private static $testMethodName;

    /**
     * Name for current Flow Stage
     *
     * @var string
     */
    private $stageName = self::TEST_MAIN_FLOW_STAGE;

    /**
     * Url of current page
     *
     * @var string
     */
    private $pageUrl;

    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * Setter for testSuiteName
     *
     * @param string $testSuiteName
     */
    public function setTestSuiteName($testSuiteName)
    {
        self::$testSuiteName = $testSuiteName;
    }

    /**
     * Setter for testClassName
     *
     * @param string $testClassName
     */
    public function setTestClassName($testClassName)
    {
        self::$testClassName = $testClassName;
    }

    /**
     * Setter for testMethodName
     *
     * @param string $testMethodName
     */
    public function setTestMethodName($testMethodName)
    {
        self::$testMethodName = $testMethodName;
    }

    /**
     * Set stage name to "persisting $fixtureName"
     *
     * @param string $fixtureName
     */
    public function startFixturePersist($fixtureName)
    {
        $this->stageName = 'Persisting ' . $fixtureName;
    }

    /**
     * Set stage name to default
     *
     * Clear handler property
     */
    public function stopFixturePersist()
    {
        $this->stageName = self::TEST_MAIN_FLOW_STAGE;
    }

    /**
     * Setter for pageUrl
     *
     * @param string $pageUrl
     */
    public function setPageUrl($pageUrl)
    {
        if ($this->pageUrl != $pageUrl) {
            $this->eventManager->dispatchEvent(
                ['page_changed'],
                [sprintf('Page changed from url %s to url %s', $this->pageUrl, $pageUrl)]
            );
            $this->pageUrl = $pageUrl;
        }
    }

    /**
     * Getter for $testSuiteName
     *
     * @return string
     */
    public function getTestSuiteName()
    {
        return self::$testSuiteName ?: 'default';
    }

    /**
     * Getter for $testClassName
     *
     * @return string
     */
    public function getTestClassName()
    {
        return self::$testClassName ?: 'default';
    }

    /**
     * Getter for $testMethodName
     *
     * @return string
     */
    public function getTestMethodName()
    {
        return self::$testMethodName ?: 'default';
    }

    /**
     * Getter for current $stageName
     *
     * @return string
     */
    public function getStageName()
    {
        return $this->stageName ?: 'default';
    }

    /**
     * Getter for current pageUrl
     *
     * @return string
     */
    public function getPageUrl()
    {
        return $this->pageUrl ?: 'default';
    }
}
