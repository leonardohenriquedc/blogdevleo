#include <stdio.h>
#include <string.h>
#include <stdlib.h>

char title[555];
char author[200];
char date[12];
char tags[10][100];

void get_input(char *prompt, char *buffer, int size) {
    printf("%s", prompt);
    fgets(buffer, size, stdin);
}

char *format() {

    int totalTagsLen = 0;

    for (int i = 0; i < 10; i++) {
        for (int j = 0; j < 100; j++) {
            if(tags[i][j] == '\n'){
                tags[i][j] = '\0';
            }
        }
        if (tags[i][0] == '\0')
            break;

        totalTagsLen += strlen(tags[i]) * 2;
    }

    size_t size =
        strlen(title) +
        strlen(author) +
        strlen(date) +
        strlen("---\n") * 2 +
        strlen("title: ") +
        strlen("author: ") +
        strlen("date: ") +
        strlen("tags: [") +
        strlen("]\n") +
        totalTagsLen +
        100 +
        1;

    char *buffer = malloc(size);

    buffer[0] = '\0';

    strcat(buffer, "---\n");
    strcat(buffer, "title: ");
    strcat(buffer, title);

    strcat(buffer, "author: ");
    strcat(buffer, author);

    strcat(buffer, "date: ");
    strcat(buffer, date);

    strcat(buffer, "tags: [");


    for(int i=0; i<10; i++) {
        if(tags[i][0] == '\0') break;
        strcat(buffer, "\"");
        strcat(buffer, tags[i]);
        strcat(buffer, "\"");
        strcat(buffer, ", ");
    }

    strcat(buffer, "]\n");
    strcat(buffer, "---\n");

    printf("%s", buffer);

    return buffer;
}

int main() {

    char *file_path = malloc((200*sizeof(char)));

    printf("Welcome CLI of the my blog, Please provide the following information: title, author,  date and tags if applicable.\n");

    get_input("Por favor insirar o caminho do arquivo: ", file_path, (200*sizeof(char)));
    get_input("Por favor insira o titulo: ", title, 555);
    get_input("Por favor insira o autor: ", author, 200);
    get_input("Por favor insira a data no formato dd-mm-yyyy: ", date, 12);

    for(int num = 0; num < 10; num++){
        printf("\nNum FOR: %d\n", num);
        get_input("Por favor insira as tags: ", tags[num], 100);
        if(tags[num][0] == '\n'){
            break;
        }
    }

    for(int num = 0; num < strlen(file_path); num++){
        if(file_path[num] == '\n'){
            file_path[num] = '\0';
        }
    }

    strcat(file_path, title);

    for(int num = 0; num < strlen(file_path); num++){
        if(file_path[num] == '\n'){
            file_path[num] = '\0';
        }
    }
    strcat(file_path, ".md");
    char *form = format();
    FILE *file = fopen(file_path, "w");
    if (file == NULL) {
        printf("Error opening file!\n");
        return 1;
    }

    fprintf(file, "%s", form);

    fclose(file);

    free(file_path);
    free(form);

    return 0;
}
