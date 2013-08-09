<?php

    namespace Simplon\Tlogger;

    class Tlogger
    {
        protected $_urlLoggingPath;
        protected $_topicId;
        protected $_parameters = [];

        // ######################################

        /**
         * @param $urlLoggingPath
         */
        public function __construct($urlLoggingPath)
        {
            $this->_urlLoggingPath = $urlLoggingPath;
        }

        // ######################################

        /**
         * @return mixed
         */
        protected function _getUrlLoggingPath()
        {
            return $this->_urlLoggingPath;
        }

        // ######################################

        /**
         * @param $topicId
         *
         * @return $this
         */
        public function setTopicId($topicId)
        {
            return $this->addParameter('tid', $topicId);
        }

        // ######################################

        /**
         * @param $parameters
         *
         * @return $this
         */
        public function setParameters($parameters)
        {
            $this->_parameters = array_merge($this->_parameters, $parameters);

            return $this;
        }

        // ######################################

        /**
         * @param $key
         * @param $value
         *
         * @return $this
         */
        public function addParameter($key, $value)
        {
            $this->_parameters[$key] = $value;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        protected function _getParameters()
        {
            return $this->_parameters;
        }

        // ######################################

        /**
         * @return string
         */
        protected function _getParametersAsUrlQuery()
        {
            return http_build_query($this->_getParameters());
        }

        // ######################################

        /**
         * @return bool
         */
        public function push()
        {
            // build final url
            $urlLoggingPathWithParameters = $this->_getUrlLoggingPath() . '?' . $this->_getParametersAsUrlQuery();

            // log data
            \CURL::init($urlLoggingPathWithParameters)
                ->setReturnTransfer(TRUE)
                ->execute();

            // reset data
            $this->reset();

            return TRUE;
        }

        // ######################################

        /**
         * @return $this
         */
        public function reset()
        {
            $this->_parameters = [];

            return $this;
        }
    }
