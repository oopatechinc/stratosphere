export const useGreetings = (word: string) => {
    function greet(word) {
        return "Hello " + word
    }

    return {greet}
}