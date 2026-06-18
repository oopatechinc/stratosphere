import {useSanctumClient} from "#imports";

export const useFileService = () => {
  const client = useSanctumClient()

  const ACTION_UPLOAD = 'upload';
  const ACTION_REPLACE = 'replace';
  const ACTION_DELETE = 'delete';

  function send(
    file: File | undefined,
    entityType: string,
    entityId: number,
    action: string,
    itemType: string = ''
  ) {
    const formData = new FormData()
    formData.append('file', file as Blob)
    formData.append('entity_type', entityType)
    formData.append('entity_id', String(entityId))
    formData.append('item_type', itemType)

    if (![ACTION_UPLOAD, ACTION_REPLACE, ACTION_DELETE].includes(action)) {
      throw Error('Invalid action type!')
    }

    return client(`/files/${action}`, {method: 'POST', body: formData})
  }

  return {ACTION_UPLOAD, ACTION_REPLACE, ACTION_DELETE, send}
}
