LOCAL_PATH := $(call my-dir)

include $(CLEAR_VARS)

LOCAL_MODULE    := uzibo
LOCAL_SRC_FILES := uzibo.c

include $(BUILD_SHARED_LIBRARY)