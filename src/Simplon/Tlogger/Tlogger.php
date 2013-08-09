<?php

    namespace Simplon\Tlogger;

    class Tlogger
    {
        protected $_urlLogging;
        protected $_topicId;
        protected $_parameters = [];

        // ######################################

        /**
         * @param $urlLogging
         */
        public function __construct($urlLogging)
        {
            $this->_urlLogging = $urlLogging;
        }

        // ######################################

        /**
         * @return string
         */
        protected function _getUrlLogging()
        {
            return rtrim($this->_urlLogging, '/');
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
         * @param array $parameters
         *
         * @return $this
         */
        public function setParameters(array $parameters)
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
         * @return string
         */
        protected function _getFinalUrlWithParameters()
        {
            return $this->_getUrlLogging() . '?' . $this->_getParametersAsUrlQuery();
        }

        // ######################################

        /**
         * @return bool
         */
        public function release()
        {
            // log data
            \CURL::init($this->_getFinalUrlWithParameters())
                ->execute();

            // reset data
            $this->_reset();

            return TRUE;
        }

        // ######################################

        /**
         * @return $this
         */
        protected function _reset()
        {
            $this->_parameters = [];

            return $this;
        }
    }
