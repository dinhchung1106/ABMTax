import { ref } from 'vue';
import { ElMessage } from 'element-plus';

export function useImageUpload(options = {}) {
  const {
    maxSize = 2048, // Max size in KB
    allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'],
    storagePath = 'uploads', // Default storage path
  } = options;

  const imageFile = ref(null);
  const imagePreviewUrl = ref(null);
  const imageInputKey = ref(0);
  const uploading = ref(false);

  const validateImage = (file) => {
    // Check file type
    if (!allowedTypes.includes(file.type)) {
      ElMessage.error('Định dạng file không hợp lệ. Chỉ chấp nhận: JPG, JPEG, PNG, GIF, SVG');
      return false;
    }

    // Check file size (convert to KB)
    const fileSizeInKB = file.size / 1024;
    if (fileSizeInKB > maxSize) {
      ElMessage.error(`Kích thước file không được vượt quá ${maxSize}KB`);
      return false;
    }

    return true;
  };

  const handleImageChange = (event) => {
    const file = event.target.files[0];
    if (file) {
      if (!validateImage(file)) {
        // Reset file input if validation fails
        imageInputKey.value++;
        return;
      }

      imageFile.value = file;
      imagePreviewUrl.value = URL.createObjectURL(file);
    } else {
      imageFile.value = null;
      imagePreviewUrl.value = null;
    }
  };

  const removeImage = () => {
    imageFile.value = null;
    imagePreviewUrl.value = null;
    imageInputKey.value++;
  };

  const getImageUrl = (path) => {
    if (!path) return null;
    return path.startsWith('/storage/') ? path : `/storage/${path}`;
  };

  const appendImageToFormData = (formData, fieldName = 'image') => {
    if (imageFile.value) {
      formData.append(fieldName, imageFile.value);
    }
  };

  const resetImageState = () => {
    imageFile.value = null;
    imagePreviewUrl.value = null;
    imageInputKey.value++;
  };

  return {
    // State
    imageFile,
    imagePreviewUrl,
    imageInputKey,
    uploading,

    // Methods
    handleImageChange,
    removeImage,
    getImageUrl,
    appendImageToFormData,
    resetImageState,
    validateImage,
  };
} 